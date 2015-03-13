<?php

interface RegisterInterface {

    public function RegisterSuccessful($email,$password);
    public function RegisterFailed();
}