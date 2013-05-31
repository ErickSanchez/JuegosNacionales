<?php
class Validate {

     /* @var $rule_email_unique Validate */
    private $rule_email_unique;
    /* @var $rule_enrollment_unique Validate */
    private $rule_enrollment_unique;

    function Validate() {

        $this->rule_email_unique='|is_unique[participantmeta.email]';
        $this->rule_enrollment_unique='|is_unique[participantathlete.schoolEnrollment]';
        $this->rule_curp_unique='|is_unique[participantmeta.curp]';
    }
    function set_rules_update(){
        $this->rule_email_unique='';
        $this->rule_enrollment_unique='';
        $this->rule_curp_unique='';

    }
    function set_rules($form_validation){

           $config = array(
               array(
                     'field'   => 'email',
                     'label'   => 'Este email',
                     'rules'   => 'valid_email'
                  ),
               array(
                     'field'   => 'lastname',
                     'label'   => 'Apellido Paterno',
                     'rules'   => 'required'
                  ),

               array(
                     'field'   => 'surname',
                     'label'   => 'Apellido Materno',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'firstname',
                     'label'   => 'Nombre',
                     'rules'   => 'required'
                  ),

               array(
                     'field'   => 'curp',
                     'label'   => 'La CURP',
                     'rules'   => 'exact_length[18]'
                  ),

               array(
                     'field'   => 'cellphone',
                     'label'   => 'Celular',
                     'rules'   => 'integer'
                  ),

               array(
                     'field'   => 'phone',
                     'label'   => 'Telefono',
                     'rules'   => 'integer'
                   ),
               array(
                     'field'   => 'jersey-number',
                     'label'   => 'Numero',
                     'rules'   => 'integer'
                  ),
               array(
                     'field'   => 'birthdate-year',
                     'label'   => 'año de nacimiento',
                     'rules'   => 'callback_validate_number_of_years'
                  )
               );

        $form_validation->set_rules($config);

        $form_validation->set_rules('file-photo', 'La Fotografia', 'callback_validate_size_file[file-photo]');

        if(@!$_POST['coach'])
        {
            $form_validation->set_rules('enrollment', 'Matricula','required'.$this->rule_enrollment_unique);

            $form_validation->set_rules('file-birth', 'El Acta de nacimiento', 'callback_validate_size_file[file-birth]');
            $form_validation->set_rules('file-Certificate', 'La Constancia de estudios', 'callback_validate_size_file[file-Certificate]');
            $form_validation->set_rules('file-CURP', 'La CURP', 'callback_validate_size_file[file-CURP]');
            $form_validation->set_rules('file-academicHistory', 'El Historial academico', 'callback_validate_size_file[file-academicHistory]');
            $form_validation->set_rules('file-schoolCard-front', 'La Credencial de Estudiante (anverso)', 'callback_validate_size_file[file-schoolCard-front]');
            $form_validation->set_rules('file-schoolCard-back', 'La Credencial de Estudiante (reverso)', 'callback_validate_size_file[file-schoolCard-back]');

        }

       
        $form_validation->set_message('validate_number_of_years', '* Este eqipo ya tiene '.LIMIT_PARTICIPANT_1993.' registros con este %s');
        
        $form_validation->set_message('required', '* El campo %s es obligatorio');
        $form_validation->set_message('valid_email', '* Este email es invalido');
        $form_validation->set_message('is_unique', '* %s ya esta en nuestros registros');
        $form_validation->set_message('integer', '* Solo se admiten numeros');

        $form_validation->set_message('exact_length', '* %s debe ser de %s caracteres');

        $form_validation->set_error_delimiters('<div class="error">', '</div>');
    }
    
    


}

