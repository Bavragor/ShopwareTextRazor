<?php

namespace Shopware\ShopwareTextRazor\Service;

class TextRazor
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var \TextRazor
     */
    private $textRazor;

    /**
     * Service wrapper for TextRazor
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->textRazor = new \TextRazor($token);
    }

    /**
     * @return \TextRazor
     */
    public function getTextRazor()
    {
        return $this->textRazor;
    }
}
