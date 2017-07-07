<?php
namespace dompdfmodule;

class Module
{
    public function getConfig()
    {
        return [
            'service_manager' => [
                'shared' => [
                    'dompdf' => false,
                ],
                'factories' => [
                    'dompdf' => 'dompdfmodule\Factory\dompdfFactory',
                ],
            ],
        ];
    }
}
