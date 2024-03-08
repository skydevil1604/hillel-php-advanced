<?php

namespace App\Validators\Masters;

class UpdateMasterValidator extends CreateMasterValidator
{
    protected array $skip = ['updated_at'];
}
