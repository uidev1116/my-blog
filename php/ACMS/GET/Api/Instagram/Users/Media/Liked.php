<?php

class ACMS_GET_Api_Instagram_Users_Media_Liked extends ACMS_GET_Api_Instagram_Users_Media
{
    var $_scope = array(
        'field'     => 'global',
    );

    function get() {

        $this->id     = $this->bid;
        $this->api    = '/users/self/media/liked';
        $this->params = array_clean(array(
            'max_id'  => ($next_max_id = $this->Field->get('next_max_id')) ? intval($next_max_id) : null,
            'count'   => !!LIMIT ? LIMIT : config('instagram_users_media_liked_limit')
        ));
        $this->crit   = config('instagram_users_media_liked_cache_expire');

        $Tpl = new Template($this->tpl, new ACMS_Corrector());
        $this->buildModuleField($Tpl);

        $this->resolveRequest($Tpl, 'instagram');

        return $Tpl->get();
    }
}