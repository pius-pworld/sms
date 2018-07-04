<?php
    function customDropdown($function_name)
    {
        return Form::select('program_id', $function_name(), null, ['class' => 'program_id form-control select2']);
    }
?>