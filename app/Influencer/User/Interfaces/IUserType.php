<?php

namespace App\Influencer\User\Interfaces;

interface IUserType {

    /**
     * A princípio devemos usar esse tipo de interface para os tipos de usuários (Agency, Brand, Influencer).
     * Ainda precisa ser validada a utilidade.
     *
     * @return App\Influencer\User\Interfaces\IUserType
     */
	public function getModule();
}
