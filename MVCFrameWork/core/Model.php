<?php
namespace app\core;
abstract class Model
{

    public const RULE_REQUIRED= 'required';
    public const RULE_EMAIL= 'email';
    public const RULE_MIN= 'min';
    public const RULE_MAX= 'max';
    public const RULE_MATCH= 'match';

    public array $errors=[];

    public function validate()
    {
        foreach($this->rules() as $attributes=>$rules)
        {
            $value= $this->{$attributes};
            foreach($rules as $rule)
            {
                $ruleName=$rule;
                if (!is_string($ruleName))
                {
                    $ruleName=$rule[0];
                }
                if ($ruleName===self::RULE_REQUIRED && !$value)
                {
                    $this->addERrror($attributes,self::RULE_REQUIRED);
                }
                if ($ruleName===self::RULE_EMAIL && !filter_var($value ,FILTER_VALIDATE_EMAIL ))
                {
                    $this->addERrror($attributes, self::RULE_EMAIL);
                }
                if ($ruleName===self::RULE_MIN && strlen($value)<$rule ['min'])
                {
                    $this->addERrror($attributes, self::RULE_MIN , $rule);
                }
                if ($ruleName===self::RULE_MAX && strlen($value)>$rule ['max'])
                {
                    $this->addERrror($attributes, self::RULE_MAX, $rule);
                }
                if ($ruleName===self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $this->addERrror($attributes, self::RULE_MATCH, $rule);
                }


            }
        }
        return empty($this->errors);
        // true when the "errors" is Empty so there are  no errors..

    }
    public function addERrror(string $attributes, string $rule , $params=[])
    {
        $message=$this->errorMessage()[$rule]??'';
        foreach( $params as $key=>$value )
        {
            $placeholder= '{'.$key. '}';
            $message=str_replace("{$key}" , $value , $message);
        }
        $this->errors[$attributes][]=$message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute]??false;

    }
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0]??false;
    }
    public function errorMessage()
    {

        return[
            self::RULE_REQUIRED =>'This field is requird',
            self::RULE_EMAIL =>'This field must be a valid email address',
            self::RULE_MIN =>'Min length must be {min}',
            self::RULE_MAX =>'Max length must be {max}',
            self::RULE_MATCH =>'This field must be the same as {match}',   
        ];
    }
    public function loadData($data)
    {
        foreach($data as $key=>$value)
        {
            if(property_exists($this,$key))
            {
                $this->$key=$value;
            }
        }
    }

     abstract public function rules():array;
}
