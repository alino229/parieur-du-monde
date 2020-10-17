<?php


namespace App\Form\Datatransformer;


use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenshToDateTimeTransformer implements DataTransformerInterface
{
    public function transform($date)
    {
       if($date===null){
           return '';
       }
       return $date->format('d/m/Y');
    }
    public function reverseTransform($frenshDate)
    {
        if($frenshDate===null){
         throw new TransformationFailedException();
        }
        // TODO: Implement reverseTransform() method.
        $date=\DateTime::createFromFormat('d/m/Y',$frenshDate);
        if($date===false){
            throw new TransformationFailedException("format incorrecte ");
        }
        return $date;
    }

}