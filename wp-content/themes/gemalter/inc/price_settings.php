<?php
/**
 * Price Settings
 */

//pets = persons, landscape = 1 person, custom = condition from excel)
//general prices settings for two langs
$prices = [
    'en' => [
        'currency' => 'usd',
        'currency_symbol' => '$',
        'use_size' => 'inch',// inch or cm
        'prices' => [
            'painting_technique' => [
                'charcoal' => [
                    'person_1' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => true,
                                'regular' => [
                                    'price' => '89',
                                    'old_price' => '89',
                                ],
                                'express' => [
                                    'price' => '102',
                                    'old_price' => '102',
                                ],
                                'super_express' => [
                                    'price' => '111',
                                    'old_price' => '111',
                                ],
                                'request' => [
                                    'price' => '120',
                                    'old_price' => '120',
                                ],
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => true,
                                'regular' => [
                                    'price' => '109',
                                    'old_price' => '109',
                                ],
                                'express' => [
                                    'price' => '125',
                                    'old_price' => '125',
                                ],
                                'super_express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'request' => [
                                    'price' => '147',
                                    'old_price' => '147',
                                ],
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '119',
                                    'old_price' => '119',
                                ],
                                'express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'super_express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'request' => [
                                    'price' => '160',
                                    'old_price' => '160',
                                ],
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '129',
                                    'old_price' => '129',
                                ],
                                'express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'super_express' => [
                                    'price' => '161',
                                    'old_price' => '161',
                                ],
                                'request' => [
                                    'price' => '174',
                                    'old_price' => '174',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '139',
                                    'old_price' => '139',
                                ],
                                'express' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'super_express' => [
                                    'price' => '173',
                                    'old_price' => '173',
                                ],
                                'request' => [
                                    'price' => '187',
                                    'old_price' => '187',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '169',
                                    'old_price' => '179',
                                ],
                                'express' => [
                                    'price' => '194',
                                    'old_price' => '194',
                                ],
                                'super_express' => [
                                    'price' => '211',
                                    'old_price' => '211',
                                ],
                                'request' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '189',
                                    'old_price' => '199',
                                ],
                                'express' => [
                                    'price' => '217',
                                    'old_price' => '217',
                                ],
                                'super_express' => [
                                    'price' => '236',
                                    'old_price' => '236',
                                ],
                                'request' => [
                                    'price' => '255',
                                    'old_price' => '255',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '209',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '240',
                                    'old_price' => '240',
                                ],
                                'super_express' => [
                                    'price' => '261',
                                    'old_price' => '261',
                                ],
                                'request' => [
                                    'price' => '282',
                                    'old_price' => '282',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                        ]
                    ],
                    'person_2' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '139',
                                    'old_price' => '145',
                                ],
                                'express' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'super_express' => [
                                    'price' => '173',
                                    'old_price' => '173',
                                ],
                                'request' => [
                                    'price' => '187',
                                    'old_price' => '187',
                                ],
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '149',
                                    'old_price' => '149',
                                ],
                                'express' => [
                                    'price' => '171',
                                    'old_price' => '171',
                                ],
                                'super_express' => [
                                    'price' => '186',
                                    'old_price' => '186',
                                ],
                                'request' => [
                                    'price' => '201',
                                    'old_price' => '201',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'express' => [
                                    'price' => '182',
                                    'old_price' => '182',
                                ],
                                'super_express' => [
                                    'price' => '198',
                                    'old_price' => '198',
                                ],
                                'request' => [
                                    'price' => '214',
                                    'old_price' => '214',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '199',
                                    'old_price' => '199',
                                ],
                                'express' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                                'super_express' => [
                                    'price' => '248',
                                    'old_price' => '248',
                                ],
                                'request' => [
                                    'price' => '268',
                                    'old_price' => '268',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '219',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '251',
                                    'old_price' => '251',
                                ],
                                'super_express' => [
                                    'price' => '273',
                                    'old_price' => '273',
                                ],
                                'request' => [
                                    'price' => '295',
                                    'old_price' => '295',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '289',
                                    'old_price' => '289',
                                ],
                                'express' => [
                                    'price' => '332',
                                    'old_price' => '322',
                                ],
                                'super_express' => [
                                    'price' => '361',
                                    'old_price' => '361',
                                ],
                                'request' => [
                                    'price' => '390',
                                    'old_price' => '390',
                                ],
                            ],
                        ]
                    ],
                    'person_3' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '169',
                                    'old_price' => '169',
                                ],
                                'express' => [
                                    'price' => '194',
                                    'old_price' => '194',
                                ],
                                'super_express' => [
                                    'price' => '211',
                                    'old_price' => '211',
                                ],
                                'request' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '179',
                                    'old_price' => '179',
                                ],
                                'express' => [
                                    'price' => '205',
                                    'old_price' => '205',
                                ],
                                'super_express' => [
                                    'price' => '223',
                                    'old_price' => '223',
                                ],
                                'request' => [
                                    'price' => '241',
                                    'old_price' => '241',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '229',
                                    'old_price' => '229',
                                ],
                                'express' => [
                                    'price' => '263',
                                    'old_price' => '263',
                                ],
                                'super_express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'request' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '289',
                                    'old_price' => '289',
                                ],
                                'express' => [
                                    'price' => '332',
                                    'old_price' => '332',
                                ],
                                'super_express' => [
                                    'price' => '361',
                                    'old_price' => '361',
                                ],
                                'request' => [
                                    'price' => '390',
                                    'old_price' => '390',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '329',
                                    'old_price' => '329',
                                ],
                                'express' => [
                                    'price' => '378',
                                    'old_price' => '378',
                                ],
                                'super_express' => [
                                    'price' => '411',
                                    'old_price' => '411',
                                ],
                                'request' => [
                                    'price' => '444',
                                    'old_price' => '444',
                                ],
                            ],
                        ]
                    ],
                    'person_4' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '199',
                                    'old_price' => '199',
                                ],
                                'express' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                                'super_express' => [
                                    'price' => '248',
                                    'old_price' => '248',
                                ],
                                'request' => [
                                    'price' => '268',
                                    'old_price' => '268',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '259',
                                    'old_price' => '259',
                                ],
                                'express' => [
                                    'price' => '297',
                                    'old_price' => '297',
                                ],
                                'super_express' => [
                                    'price' => '323',
                                    'old_price' => '323',
                                ],
                                'request' => [
                                    'price' => '349',
                                    'old_price' => '349',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '279',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '320',
                                    'old_price' => '320',
                                ],
                                'super_express' => [
                                    'price' => '348',
                                    'old_price' => '348',
                                ],
                                'request' => [
                                    'price' => '376',
                                    'old_price' => '376',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '329',
                                    'old_price' => '329',
                                ],
                                'express' => [
                                    'price' => '378',
                                    'old_price' => '378',
                                ],
                                'super_express' => [
                                    'price' => '411',
                                    'old_price' => '411',
                                ],
                                'request' => [
                                    'price' => '444',
                                    'old_price' => '444',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '369',
                                    'old_price' => '369',
                                ],
                                'express' => [
                                    'price' => '424',
                                    'old_price' => '424',
                                ],
                                'super_express' => [
                                    'price' => '461',
                                    'old_price' => '461',
                                ],
                                'request' => [
                                    'price' => '498',
                                    'old_price' => '498',
                                ],
                            ],
                        ]
                    ],
                    'person_5' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'express' => [
                                    'price' => '355',
                                    'old_price' => '355',
                                ],
                                'super_express' => [
                                    'price' => '386',
                                    'old_price' => '386',
                                ],
                                'request' => [
                                    'price' => '417',
                                    'old_price' => '417',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '369',
                                    'old_price' => '369',
                                ],
                                'express' => [
                                    'price' => '424',
                                    'old_price' => '424',
                                ],
                                'super_express' => [
                                    'price' => '461',
                                    'old_price' => '461',
                                ],
                                'request' => [
                                    'price' => '498',
                                    'old_price' => '498',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '409',
                                    'old_price' => '409',
                                ],
                                'express' => [
                                    'price' => '470',
                                    'old_price' => '470',
                                ],
                                'super_express' => [
                                    'price' => '511',
                                    'old_price' => '511',
                                ],
                                'request' => [
                                    'price' => '552',
                                    'old_price' => '552',
                                ],
                            ],
                        ]
                    ],
                    'person_6' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '409',
                                    'old_price' => '409',
                                ],
                                'express' => [
                                    'price' => '470',
                                    'old_price' => '470',
                                ],
                                'super_express' => [
                                    'price' => '511',
                                    'old_price' => '511',
                                ],
                                'request' => [
                                    'price' => '552',
                                    'old_price' => '552',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '449',
                                    'old_price' => '449',
                                ],
                                'express' => [
                                    'price' => '516',
                                    'old_price' => '516',
                                ],
                                'super_express' => [
                                    'price' => '561',
                                    'old_price' => '561',
                                ],
                                'request' => [
                                    'price' => '606',
                                    'old_price' => '606',
                                ],
                            ],
                        ]
                    ],
                    'person_7' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '489',
                                    'old_price' => '489',
                                ],
                                'express' => [
                                    'price' => '562',
                                    'old_price' => '562',
                                ],
                                'super_express' => [
                                    'price' => '611',
                                    'old_price' => '611',
                                ],
                                'request' => [
                                    'price' => '660',
                                    'old_price' => '660',
                                ],
                            ],
                        ]
                    ],
                ],
                'oil' => [
                    'person_1' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '169',
                                    'old_price' => '169',
                                ],
                                'express' => [
                                    'price' => '194',
                                    'old_price' => '194',
                                ],
                                'super_express' => [
                                    'price' => '211',
                                    'old_price' => '211',
                                ],
                                'request' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => true,
                                'regular' => [
                                    'price' => '199',
                                    'old_price' => '209',
                                ],
                                'express' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                                'super_express' => [
                                    'price' => '248',
                                    'old_price' => '248',
                                ],
                                'request' => [
                                    'price' => '268',
                                    'old_price' => '268',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '239',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '274',
                                    'old_price' => '274',
                                ],
                                'super_express' => [
                                    'price' => '298',
                                    'old_price' => '298',
                                ],
                                'request' => [
                                    'price' => '322',
                                    'old_price' => '322',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '269',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'super_express' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                                'request' => [
                                    'price' => '363',
                                    'old_price' => '363',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '319',
                                    'old_price' => '319',
                                ],
                                'express' => [
                                    'price' => '366',
                                    'old_price' => '366',
                                ],
                                'super_express' => [
                                    'price' => '398',
                                    'old_price' => '398',
                                ],
                                'request' => [
                                    'price' => '430',
                                    'old_price' => '430',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '359',
                                    'old_price' => '359',
                                ],
                                'express' => [
                                    'price' => '412',
                                    'old_price' => '412',
                                ],
                                'super_express' => [
                                    'price' => '448',
                                    'old_price' => '448',
                                ],
                                'request' => [
                                    'price' => '484',
                                    'old_price' => '484',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '429',
                                    'old_price' => '429',
                                ],
                                'express' => [
                                    'price' => '493',
                                    'old_price' => '493',
                                ],
                                'super_express' => [
                                    'price' => '536',
                                    'old_price' => '536',
                                ],
                                'request' => [
                                    'price' => '579',
                                    'old_price' => '579',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '529',
                                    'old_price' => '529',
                                ],
                                'express' => [
                                    'price' => '608',
                                    'old_price' => '608',
                                ],
                                'super_express' => [
                                    'price' => '661',
                                    'old_price' => '661',
                                ],
                                'request' => [
                                    'price' => '714',
                                    'old_price' => '714',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '889',
                                    'old_price' => '889',
                                ],
                                'express' => [
                                    'price' => '1022',
                                    'old_price' => '1022',
                                ],
                                'super_express' => [
                                    'price' => '1111',
                                    'old_price' => '1111',
                                ],
                                'request' => [
                                    'price' => '1200',
                                    'old_price' => '1200',
                                ],
                            ],
                        ]
                    ],
                    'person_2' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => true,
                                'regular' => [
                                    'price' => '219',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '251',
                                    'old_price' => '251',
                                ],
                                'super_express' => [
                                    'price' => '273',
                                    'old_price' => '273',
                                ],
                                'request' => [
                                    'price' => '295',
                                    'old_price' => '295',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '259',
                                    'old_price' => '259',
                                ],
                                'express' => [
                                    'price' => '297',
                                    'old_price' => '297',
                                ],
                                'super_express' => [
                                    'price' => '323',
                                    'old_price' => '323',
                                ],
                                'request' => [
                                    'price' => '349',
                                    'old_price' => '349',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '299',
                                    'old_price' => '299',
                                ],
                                'express' => [
                                    'price' => '343',
                                    'old_price' => '343',
                                ],
                                'super_express' => [
                                    'price' => '373',
                                    'old_price' => '373',
                                ],
                                'request' => [
                                    'price' => '403',
                                    'old_price' => '403',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '349',
                                    'old_price' => '349',
                                ],
                                'express' => [
                                    'price' => '401',
                                    'old_price' => '401',
                                ],
                                'super_express' => [
                                    'price' => '436',
                                    'old_price' => '436',
                                ],
                                'request' => [
                                    'price' => '471',
                                    'old_price' => '471',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '389',
                                    'old_price' => '389',
                                ],
                                'express' => [
                                    'price' => '447',
                                    'old_price' => '447',
                                ],
                                'super_express' => [
                                    'price' => '486',
                                    'old_price' => '486',
                                ],
                                'request' => [
                                    'price' => '525',
                                    'old_price' => '525',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '469',
                                    'old_price' => '469',
                                ],
                                'express' => [
                                    'price' => '539',
                                    'old_price' => '539',
                                ],
                                'super_express' => [
                                    'price' => '586',
                                    'old_price' => '586',
                                ],
                                'request' => [
                                    'price' => '633',
                                    'old_price' => '633',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '579',
                                    'old_price' => '579',
                                ],
                                'express' => [
                                    'price' => '665',
                                    'old_price' => '665',
                                ],
                                'super_express' => [
                                    'price' => '723',
                                    'old_price' => '723',
                                ],
                                'request' => [
                                    'price' => '781',
                                    'old_price' => '781',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '939',
                                    'old_price' => '939',
                                ],
                                'express' => [
                                    'price' => '1079',
                                    'old_price' => '1079',
                                ],
                                'super_express' => [
                                    'price' => '1173',
                                    'old_price' => '1173',
                                ],
                                'request' => [
                                    'price' => '1267',
                                    'old_price' => '1267',
                                ],
                            ],
                        ]
                    ],
                    'person_3' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '279',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '320',
                                    'old_price' => '320',
                                ],
                                'super_express' => [
                                    'price' => '348',
                                    'old_price' => '348',
                                ],
                                'request' => [
                                    'price' => '376',
                                    'old_price' => '376',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '329',
                                    'old_price' => '329',
                                ],
                                'express' => [
                                    'price' => '378',
                                    'old_price' => '378',
                                ],
                                'super_express' => [
                                    'price' => '411',
                                    'old_price' => '411',
                                ],
                                'request' => [
                                    'price' => '444',
                                    'old_price' => '444',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '379',
                                    'old_price' => '379',
                                ],
                                'express' => [
                                    'price' => '435',
                                    'old_price' => '435',
                                ],
                                'super_express' => [
                                    'price' => '473',
                                    'old_price' => '473',
                                ],
                                'request' => [
                                    'price' => '511',
                                    'old_price' => '511',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '419',
                                    'old_price' => '419',
                                ],
                                'express' => [
                                    'price' => '481',
                                    'old_price' => '481',
                                ],
                                'super_express' => [
                                    'price' => '523',
                                    'old_price' => '523',
                                ],
                                'request' => [
                                    'price' => '565',
                                    'old_price' => '565',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '509',
                                    'old_price' => '509',
                                ],
                                'express' => [
                                    'price' => '585',
                                    'old_price' => '585',
                                ],
                                'super_express' => [
                                    'price' => '636',
                                    'old_price' => '636',
                                ],
                                'request' => [
                                    'price' => '687',
                                    'old_price' => '687',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '629',
                                    'old_price' => '629',
                                ],
                                'express' => [
                                    'price' => '723',
                                    'old_price' => '723',
                                ],
                                'super_express' => [
                                    'price' => '786',
                                    'old_price' => '786',
                                ],
                                'request' => [
                                    'price' => '849',
                                    'old_price' => '849',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '989',
                                    'old_price' => '989',
                                ],
                                'express' => [
                                    'price' => '1137',
                                    'old_price' => '1137',
                                ],
                                'super_express' => [
                                    'price' => '1236',
                                    'old_price' => '1236',
                                ],
                                'request' => [
                                    'price' => '1335',
                                    'old_price' => '1335',
                                ],
                            ],
                        ]
                    ],
                    'person_4' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '359',
                                    'old_price' => '359',
                                ],
                                'express' => [
                                    'price' => '412',
                                    'old_price' => '412',
                                ],
                                'super_express' => [
                                    'price' => '448',
                                    'old_price' => '448',
                                ],
                                'request' => [
                                    'price' => '484',
                                    'old_price' => '484',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '409',
                                    'old_price' => '409',
                                ],
                                'express' => [
                                    'price' => '470',
                                    'old_price' => '470',
                                ],
                                'super_express' => [
                                    'price' => '511',
                                    'old_price' => '511',
                                ],
                                'request' => [
                                    'price' => '552',
                                    'old_price' => '552',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '439',
                                    'old_price' => '439',
                                ],
                                'express' => [
                                    'price' => '504',
                                    'old_price' => '504',
                                ],
                                'super_express' => [
                                    'price' => '548',
                                    'old_price' => '548',
                                ],
                                'request' => [
                                    'price' => '592',
                                    'old_price' => '592',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '549',
                                    'old_price' => '549',
                                ],
                                'express' => [
                                    'price' => '631',
                                    'old_price' => '631',
                                ],
                                'super_express' => [
                                    'price' => '686',
                                    'old_price' => '686',
                                ],
                                'request' => [
                                    'price' => '741',
                                    'old_price' => '741',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '679',
                                    'old_price' => '679',
                                ],
                                'express' => [
                                    'price' => '780',
                                    'old_price' => '780',
                                ],
                                'super_express' => [
                                    'price' => '848',
                                    'old_price' => '848',
                                ],
                                'request' => [
                                    'price' => '916',
                                    'old_price' => '916',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1039',
                                    'old_price' => '1039',
                                ],
                                'express' => [
                                    'price' => '1194',
                                    'old_price' => '1194',
                                ],
                                'super_express' => [
                                    'price' => '1298',
                                    'old_price' => '1298',
                                ],
                                'request' => [
                                    'price' => '1402',
                                    'old_price' => '1402',
                                ],
                            ],
                        ]
                    ],
                    'person_5' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '469',
                                    'old_price' => '469',
                                ],
                                'express' => [
                                    'price' => '539',
                                    'old_price' => '539',
                                ],
                                'super_express' => [
                                    'price' => '586',
                                    'old_price' => '586',
                                ],
                                'request' => [
                                    'price' => '633',
                                    'old_price' => '633',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '589',
                                    'old_price' => '589',
                                ],
                                'express' => [
                                    'price' => '677',
                                    'old_price' => '677',
                                ],
                                'super_express' => [
                                    'price' => '736',
                                    'old_price' => '736',
                                ],
                                'request' => [
                                    'price' => '795',
                                    'old_price' => '795',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '729',
                                    'old_price' => '729',
                                ],
                                'express' => [
                                    'price' => '838',
                                    'old_price' => '838',
                                ],
                                'super_express' => [
                                    'price' => '911',
                                    'old_price' => '911',
                                ],
                                'request' => [
                                    'price' => '984',
                                    'old_price' => '984',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1089',
                                    'old_price' => '1089',
                                ],
                                'express' => [
                                    'price' => '1252',
                                    'old_price' => '1252',
                                ],
                                'super_express' => [
                                    'price' => '1361',
                                    'old_price' => '1361',
                                ],
                                'request' => [
                                    'price' => '1470',
                                    'old_price' => '1470',
                                ],
                            ],
                        ]
                    ],
                    'person_6' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '639',
                                    'old_price' => '639',
                                ],
                                'express' => [
                                    'price' => '734',
                                    'old_price' => '734',
                                ],
                                'super_express' => [
                                    'price' => '798',
                                    'old_price' => '798',
                                ],
                                'request' => [
                                    'price' => '862',
                                    'old_price' => '862',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '779',
                                    'old_price' => '779',
                                ],
                                'express' => [
                                    'price' => '895',
                                    'old_price' => '895',
                                ],
                                'super_express' => [
                                    'price' => '973',
                                    'old_price' => '973',
                                ],
                                'request' => [
                                    'price' => '1051',
                                    'old_price' => '1051',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1139',
                                    'old_price' => '1139',
                                ],
                                'express' => [
                                    'price' => '1309',
                                    'old_price' => '1309',
                                ],
                                'super_express' => [
                                    'price' => '1423',
                                    'old_price' => '1423',
                                ],
                                'request' => [
                                    'price' => '1537',
                                    'old_price' => '1537',
                                ],
                            ],
                        ]
                    ],
                    'person_7' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '829',
                                    'old_price' => '829',
                                ],
                                'express' => [
                                    'price' => '953',
                                    'old_price' => '953',
                                ],
                                'super_express' => [
                                    'price' => '1036',
                                    'old_price' => '1036',
                                ],
                                'request' => [
                                    'price' => '1119',
                                    'old_price' => '1119',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1189',
                                    'old_price' => '1189',
                                ],
                                'express' => [
                                    'price' => '1367',
                                    'old_price' => '1367',
                                ],
                                'super_express' => [
                                    'price' => '1486',
                                    'old_price' => '1486',
                                ],
                                'request' => [
                                    'price' => '1605',
                                    'old_price' => '1605',
                                ],
                            ],
                        ]
                    ],
                    'person_8' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '879',
                                    'old_price' => '879',
                                ],
                                'express' => [
                                    'price' => '1010',
                                    'old_price' => '1010',
                                ],
                                'super_express' => [
                                    'price' => '1098',
                                    'old_price' => '1098',
                                ],
                                'request' => [
                                    'price' => '1186',
                                    'old_price' => '1186',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1239',
                                    'old_price' => '1239',
                                ],
                                'express' => [
                                    'price' => '1424',
                                    'old_price' => '1424',
                                ],
                                'super_express' => [
                                    'price' => '1548',
                                    'old_price' => '1548',
                                ],
                                'request' => [
                                    'price' => '1672',
                                    'old_price' => '1672',
                                ],
                            ],
                        ]
                    ],
                    'person_9' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '929',
                                    'old_price' => '929',
                                ],
                                'express' => [
                                    'price' => '1068',
                                    'old_price' => '1068',
                                ],
                                'super_express' => [
                                    'price' => '1161',
                                    'old_price' => '1161',
                                ],
                                'request' => [
                                    'price' => '1254',
                                    'old_price' => '1254',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1289',
                                    'old_price' => '1289',
                                ],
                                'express' => [
                                    'price' => '1482',
                                    'old_price' => '1482',
                                ],
                                'super_express' => [
                                    'price' => '1611',
                                    'old_price' => '1611',
                                ],
                                'request' => [
                                    'price' => '1740',
                                    'old_price' => '1740',
                                ],
                            ],
                        ]
                    ],
                    'person_10' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1339',
                                    'old_price' => '1339',
                                ],
                                'express' => [
                                    'price' => '1539',
                                    'old_price' => '1539',
                                ],
                                'super_express' => [
                                    'price' => '1673',
                                    'old_price' => '1673',
                                ],
                                'request' => [
                                    'price' => '1807',
                                    'old_price' => '1807',
                                ],
                            ],
                        ]
                    ],
                    'person_11' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1389',
                                    'old_price' => '1389',
                                ],
                                'express' => [
                                    'price' => '1597',
                                    'old_price' => '1597',
                                ],
                                'super_express' => [
                                    'price' => '1736',
                                    'old_price' => '1736',
                                ],
                                'request' => [
                                    'price' => '1875',
                                    'old_price' => '1875',
                                ],
                            ],
                        ]
                    ],
                    'person_12' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1439',
                                    'old_price' => '1439',
                                ],
                                'express' => [
                                    'price' => '1654',
                                    'old_price' => '1654',
                                ],
                                'super_express' => [
                                    'price' => '1798',
                                    'old_price' => '1798',
                                ],
                                'request' => [
                                    'price' => '1942',
                                    'old_price' => '1942',
                                ],
                            ],
                        ]
                    ],
                    'person_13' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1489',
                                    'old_price' => '1489',
                                ],
                                'express' => [
                                    'price' => '1712',
                                    'old_price' => '1712',
                                ],
                                'super_express' => [
                                    'price' => '1861',
                                    'old_price' => '1861',
                                ],
                                'request' => [
                                    'price' => '2010',
                                    'old_price' => '2010',
                                ],
                            ],
                        ]
                    ],
                    'person_14' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1539',
                                    'old_price' => '1539',
                                ],
                                'express' => [
                                    'price' => '1769',
                                    'old_price' => '1769',
                                ],
                                'super_express' => [
                                    'price' => '1923',
                                    'old_price' => '1923',
                                ],
                                'request' => [
                                    'price' => '2077',
                                    'old_price' => '2077',
                                ],
                            ],
                        ]
                    ],
                    'person_15' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1589',
                                    'old_price' => '1589',
                                ],
                                'express' => [
                                    'price' => '1827',
                                    'old_price' => '1827',
                                ],
                                'super_express' => [
                                    'price' => '1986',
                                    'old_price' => '1986',
                                ],
                                'request' => [
                                    'price' => '2145',
                                    'old_price' => '2145',
                                ],
                            ],
                        ]
                    ],
                    'person_16' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1639',
                                    'old_price' => '1639',
                                ],
                                'express' => [
                                    'price' => '1884',
                                    'old_price' => '1884',
                                ],
                                'super_express' => [
                                    'price' => '2048',
                                    'old_price' => '2048',
                                ],
                                'request' => [
                                    'price' => '2212',
                                    'old_price' => '2212',
                                ],
                            ],
                        ]
                    ],
                ],

            ]
        ],
        'sizes' => [
            'charcoal' => [
                '14.8-21' => [
                    'label' => '14,8 cm x 21 cm (A5)',
                    'label_inch' => '6" x 8"',
                    'label_width' => '14,8',
                    'label_height' => '21',
                    'label_width_inch' => '6"',
                    'label_height_inch' => '8"',
                    'max_subjects' => '1',
                ],
                '21-29.7' => [
                    'label' => '21 cm x 29,7 cm (A4)',
                    'label_inch' => '8" x 12"',
                    'label_width' => '21',
                    'label_height' => '29,7',
                    'label_width_inch' => '8"',
                    'label_height_inch' => '12"',
                    'max_subjects' => '1',
                ],
                '25-35' => [
                    'label' => '25 × 35 cm',
                    'label_inch' => '10" x 14"',
                    'label_width' => '25',
                    'label_height' => '35',
                    'label_width_inch' => '10"',
                    'label_height_inch' => '14"',
                    'max_subjects' => '2',
                ],
                '29.7-42' => [
                    'label' => '29,7 x 42 cm (A3)',
                    'label_inch' => '12" x 17"',
                    'label_width' => '29,7',
                    'label_height' => '42',
                    'label_width_inch' => '12"',
                    'label_height_inch' => '17"',
                    'max_subjects' => '3',
                ],
                '35-50' => [
                    'label' => '35 x 50 cm',
                    'label_inch' => '14" x 20"',
                    'label_width' => '35',
                    'label_height' => '50',
                    'label_width_inch' => '14"',
                    'label_height_inch' => '20"',
                    'max_subjects' => '4',
                ],
                '42-59.4' => [
                    'label' => '42 x 59,4 cm (A2)',
                    'label_inch' => '17" x 23"',
                    'label_width' => '42',
                    'label_height' => '59,4',
                    'label_width_inch' => '17"',
                    'label_height_inch' => '23"',
                    'max_subjects' => '4',
                ],
                '50-70' => [
                    'label' => '50 x 70 cm',
                    'label_inch' => '20" x 28"',
                    'label_width' => '50',
                    'label_height' => '70',
                    'label_width_inch' => '20"',
                    'label_height_inch' => '28"',
                    'max_subjects' => '5',
                ],
                '59.4-84.1' => [
                    'label' => '59,4 cm x 84,1 cm (A1)',
                    'label_inch' => '23" x 33"',
                    'label_width' => '59,4',
                    'label_height' => '84,1',
                    'label_width_inch' => '23"',
                    'label_height_inch' => '33"',
                    'max_subjects' => '6',
                ],
                '70-100' => [
                    'label' => '70 x 100 cm',
                    'label_inch' => '28" x 39"',
                    'label_width' => '70',
                    'label_height' => '100',
                    'label_width_inch' => '28"',
                    'label_height_inch' => '39"',
                    'max_subjects' => '7',
                ],
            ],
            'oil' => [
                '25-35' => [
                    'label' => '25 × 35 cm',
                    'label_inch' => '10" x 14"',
                    'label_width' => '25',
                    'label_height' => '35',
                    'label_width_inch' => '10"',
                    'label_height_inch' => '14"',
                    'max_subjects' => '1',
                ],
                '30-40' => [
                    'label' => '30 x 40 cm',
                    'label_inch' => '12" x 16"',
                    'label_width' => '30',
                    'label_height' => '40',
                    'label_width_inch' => '12"',
                    'label_height_inch' => '16"',
                    'max_subjects' => '2',
                ],
                '35-50' => [
                    'label' => '35 x 50 cm',
                    'label_inch' => '14" x 20"',
                    'label_width' => '35',
                    'label_height' => '50',
                    'label_width_inch' => '14"',
                    'label_height_inch' => '20"',
                    'max_subjects' => '3',
                ],
                '40-60' => [
                    'label' => '40 x 60 cm',
                    'label_inch' => '16" x 24"',
                    'label_width' => '40',
                    'label_height' => '60',
                    'label_width_inch' => '16"',
                    'label_height_inch' => '24"',
                    'max_subjects' => '4',
                ],
                '50-70' => [
                    'label' => '50 x 70 cm',
                    'label_inch' => '20" x 28"',
                    'label_width' => '50',
                    'label_height' => '70',
                    'label_width_inch' => '20"',
                    'label_height_inch' => '28"',
                    'max_subjects' => '4',
                ],
                '60-80' => [
                    'label' => '60 x 80 cm',
                    'label_inch' => '24" x 31"',
                    'label_width' => '60',
                    'label_height' => '80',
                    'label_width_inch' => '24"',
                    'label_height_inch' => '31"',
                    'max_subjects' => '5',
                ],
                '70-100' => [
                    'label' => '70 x 100 cm',
                    'label_inch' => '28" x 39"',
                    'label_width' => '70',
                    'label_height' => '100',
                    'label_width_inch' => '28"',
                    'label_height_inch' => '39"',
                    'max_subjects' => '6',
                ],
                '90-120' => [
                    'label' => '90 x 120 cm',
                    'label_inch' => '35" x 47"',
                    'label_width' => '90',
                    'label_height' => '120',
                    'label_width_inch' => '35"',
                    'label_height_inch' => '47"',
                    'max_subjects' => '9',
                ],
                '120-180' => [
                    'label' => '120 x 180 cm',
                    'label_inch' => '47" x 71"',
                    'label_width' => '120',
                    'label_height' => '180',
                    'label_width_inch' => '47"',
                    'label_height_inch' => '71"',
                    'max_subjects' => '16',
                ],
            ],
        ],
    ],
    'de' => [
        'currency' => 'eur',
        'currency_symbol' => '€',
        'use_size' => 'cm',// inch or cm
        'prices' => [
            'painting_technique' => [
                'charcoal' => [
                    'person_1' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => true,
                                'regular' => [
                                    'price' => '59',
                                    'old_price' => '69',
                                ],
                                'express' => [
                                    'price' => '67',
                                    'old_price' => '67',
                                ],
                                'super_express' => [
                                    'price' => '73',
                                    'old_price' => '73',
                                ],
                                'request' => [
                                    'price' => '79',
                                    'old_price' => '79',
                                ],
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => true,
                                'regular' => [
                                    'price' => '69',
                                    'old_price' => '69',
                                ],
                                'express' => [
                                    'price' => '79',
                                    'old_price' => '79',
                                ],
                                'super_express' => [
                                    'price' => '86',
                                    'old_price' => '86',
                                ],
                                'request' => [
                                    'price' => '93',
                                    'old_price' => '93',
                                ],
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '79',
                                    'old_price' => '85',
                                ],
                                'express' => [
                                    'price' => '90',
                                    'old_price' => '90',
                                ],
                                'super_express' => [
                                    'price' => '98',
                                    'old_price' => '98',
                                ],
                                'request' => [
                                    'price' => '106',
                                    'old_price' => '106',
                                ],
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '89',
                                    'old_price' => '89',
                                ],
                                'express' => [
                                    'price' => '102',
                                    'old_price' => '102',
                                ],
                                'super_express' => [
                                    'price' => '111',
                                    'old_price' => '111',
                                ],
                                'request' => [
                                    'price' => '120',
                                    'old_price' => '120',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '99',
                                    'old_price' => '99',
                                ],
                                'express' => [
                                    'price' => '113',
                                    'old_price' => '113',
                                ],
                                'super_express' => [
                                    'price' => '123',
                                    'old_price' => '123',
                                ],
                                'request' => [
                                    'price' => '133',
                                    'old_price' => '133',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '119',
                                    'old_price' => '129',
                                ],
                                'express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'super_express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'request' => [
                                    'price' => '160',
                                    'old_price' => '160',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '139',
                                    'old_price' => '149',
                                ],
                                'express' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'super_express' => [
                                    'price' => '173',
                                    'old_price' => '173',
                                ],
                                'request' => [
                                    'price' => '187',
                                    'old_price' => '187',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '159',
                                    'old_price' => '169',
                                ],
                                'express' => [
                                    'price' => '182',
                                    'old_price' => '182',
                                ],
                                'super_express' => [
                                    'price' => '198',
                                    'old_price' => '198',
                                ],
                                'request' => [
                                    'price' => '214',
                                    'old_price' => '214',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '189',
                                    'old_price' => '189',
                                ],
                                'express' => [
                                    'price' => '217',
                                    'old_price' => '217',
                                ],
                                'super_express' => [
                                    'price' => '236',
                                    'old_price' => '236',
                                ],
                                'request' => [
                                    'price' => '255',
                                    'old_price' => '255',
                                ],
                            ],
                        ]
                    ],
                    'person_2' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '99',
                                    'old_price' => '99',
                                ],
                                'express' => [
                                    'price' => '113',
                                    'old_price' => '113',
                                ],
                                'super_express' => [
                                    'price' => '123',
                                    'old_price' => '123',
                                ],
                                'request' => [
                                    'price' => '133',
                                    'old_price' => '133',
                                ],
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '109',
                                    'old_price' => '119',
                                ],
                                'express' => [
                                    'price' => '125',
                                    'old_price' => '125',
                                ],
                                'super_express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'request' => [
                                    'price' => '147',
                                    'old_price' => '147',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '119',
                                    'old_price' => '119',
                                ],
                                'express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'super_express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'request' => [
                                    'price' => '160',
                                    'old_price' => '160',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '149',
                                    'old_price' => '149',
                                ],
                                'express' => [
                                    'price' => '171',
                                    'old_price' => '171',
                                ],
                                'super_express' => [
                                    'price' => '186',
                                    'old_price' => '186',
                                ],
                                'request' => [
                                    'price' => '201',
                                    'old_price' => '201',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '169',
                                    'old_price' => '169',
                                ],
                                'express' => [
                                    'price' => '194',
                                    'old_price' => '194',
                                ],
                                'super_express' => [
                                    'price' => '211',
                                    'old_price' => '211',
                                ],
                                'request' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '189',
                                    'old_price' => '189',
                                ],
                                'express' => [
                                    'price' => '217',
                                    'old_price' => '217',
                                ],
                                'super_express' => [
                                    'price' => '236',
                                    'old_price' => '236',
                                ],
                                'request' => [
                                    'price' => '255',
                                    'old_price' => '255',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '219',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '251',
                                    'old_price' => '251',
                                ],
                                'super_express' => [
                                    'price' => '273',
                                    'old_price' => '273',
                                ],
                                'request' => [
                                    'price' => '295',
                                    'old_price' => '295',
                                ],
                            ],
                        ]
                    ],
                    'person_3' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => true,
                                'regular' => [
                                    'price' => '129',
                                    'old_price' => '129',
                                ],
                                'express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'super_express' => [
                                    'price' => '161',
                                    'old_price' => '161',
                                ],
                                'request' => [
                                    'price' => '174',
                                    'old_price' => '174',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '139',
                                    'old_price' => '139',
                                ],
                                'express' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'super_express' => [
                                    'price' => '173',
                                    'old_price' => '173',
                                ],
                                'request' => [
                                    'price' => '187',
                                    'old_price' => '187',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '179',
                                    'old_price' => '179',
                                ],
                                'express' => [
                                    'price' => '205',
                                    'old_price' => '205',
                                ],
                                'super_express' => [
                                    'price' => '223',
                                    'old_price' => '223',
                                ],
                                'request' => [
                                    'price' => '241',
                                    'old_price' => '241',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '199',
                                    'old_price' => '199',
                                ],
                                'express' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                                'super_express' => [
                                    'price' => '248',
                                    'old_price' => '248',
                                ],
                                'request' => [
                                    'price' => '268',
                                    'old_price' => '268',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '219',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '251',
                                    'old_price' => '251',
                                ],
                                'super_express' => [
                                    'price' => '273',
                                    'old_price' => '273',
                                ],
                                'request' => [
                                    'price' => '295',
                                    'old_price' => '295',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                        ]
                    ],
                    'person_4' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '159',
                                    'old_price' => '159',
                                ],
                                'express' => [
                                    'price' => '182',
                                    'old_price' => '182',
                                ],
                                'super_express' => [
                                    'price' => '198',
                                    'old_price' => '198',
                                ],
                                'request' => [
                                    'price' => '214',
                                    'old_price' => '214',
                                ],
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => true,
                                'regular' => [
                                    'price' => '209',
                                    'old_price' => '209',
                                ],
                                'express' => [
                                    'price' => '240',
                                    'old_price' => '240',
                                ],
                                'super_express' => [
                                    'price' => '261',
                                    'old_price' => '261',
                                ],
                                'request' => [
                                    'price' => '282',
                                    'old_price' => '282',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '229',
                                    'old_price' => '229',
                                ],
                                'express' => [
                                    'price' => '263',
                                    'old_price' => '263',
                                ],
                                'super_express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'request' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '279',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '320',
                                    'old_price' => '320',
                                ],
                                'super_express' => [
                                    'price' => '348',
                                    'old_price' => '348',
                                ],
                                'request' => [
                                    'price' => '376',
                                    'old_price' => '376',
                                ],
                            ],
                        ]
                    ],
                    'person_5' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '259',
                                    'old_price' => '259',
                                ],
                                'express' => [
                                    'price' => '297',
                                    'old_price' => '297',
                                ],
                                'super_express' => [
                                    'price' => '323',
                                    'old_price' => '323',
                                ],
                                'request' => [
                                    'price' => '349',
                                    'old_price' => '349',
                                ],
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '279',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '320',
                                    'old_price' => '320',
                                ],
                                'super_express' => [
                                    'price' => '348',
                                    'old_price' => '348',
                                ],
                                'request' => [
                                    'price' => '376',
                                    'old_price' => '376',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'express' => [
                                    'price' => '355',
                                    'old_price' => '355',
                                ],
                                'super_express' => [
                                    'price' => '386',
                                    'old_price' => '386',
                                ],
                                'request' => [
                                    'price' => '417',
                                    'old_price' => '417',
                                ],
                            ],
                        ]
                    ],
                    'person_6' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => true,
                                'regular' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'express' => [
                                    'price' => '355',
                                    'old_price' => '355',
                                ],
                                'super_express' => [
                                    'price' => '386',
                                    'old_price' => '386',
                                ],
                                'request' => [
                                    'price' => '417',
                                    'old_price' => '417',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '339',
                                    'old_price' => '339',
                                ],
                                'express' => [
                                    'price' => '389',
                                    'old_price' => '389',
                                ],
                                'super_express' => [
                                    'price' => '423',
                                    'old_price' => '423',
                                ],
                                'request' => [
                                    'price' => '457',
                                    'old_price' => '457',
                                ],
                            ],
                        ]
                    ],
                    'person_7' => [
                        'sizes' => [
                            '14.8-21' => [
                                'label' => '14,8 cm x 21 cm (A5)',
                                'label_inch' => '6" x 8"',
                                'available' => false,
                            ],
                            '21-29.7' => [
                                'label' => '21 cm x 29,7 cm (A4)',
                                'label_inch' => '8" x 12"',
                                'available' => false,
                            ],
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '29.7-42' => [
                                'label' => '29,7 x 42 cm (A3)',
                                'label_inch' => '12" x 17"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '42-59.4' => [
                                'label' => '42 x 59,4 cm (A2)',
                                'label_inch' => '17" x 23"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '59.4-84.1' => [
                                'label' => '59,4 cm x 84,1 cm (A1)',
                                'label_inch' => '23" x 33"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '369',
                                    'old_price' => '369',
                                ],
                                'express' => [
                                    'price' => '424',
                                    'old_price' => '424',
                                ],
                                'super_express' => [
                                    'price' => '461',
                                    'old_price' => '461',
                                ],
                                'request' => [
                                    'price' => '498',
                                    'old_price' => '498',
                                ],
                            ],
                        ]
                    ],
                ],
                'oil' => [
                    'person_1' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => true,
                                'regular' => [
                                    'price' => '119',
                                    'old_price' => '119',
                                ],
                                'express' => [
                                    'price' => '136',
                                    'old_price' => '136',
                                ],
                                'super_express' => [
                                    'price' => '148',
                                    'old_price' => '148',
                                ],
                                'request' => [
                                    'price' => '160',
                                    'old_price' => '160',
                                ],
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => true,
                                'regular' => [
                                    'price' => '149',
                                    'old_price' => '159',
                                ],
                                'express' => [
                                    'price' => '171',
                                    'old_price' => '171',
                                ],
                                'super_express' => [
                                    'price' => '186',
                                    'old_price' => '186',
                                ],
                                'request' => [
                                    'price' => '201',
                                    'old_price' => '201',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '179',
                                    'old_price' => '189',
                                ],
                                'express' => [
                                    'price' => '205',
                                    'old_price' => '205',
                                ],
                                'super_express' => [
                                    'price' => '223',
                                    'old_price' => '223',
                                ],
                                'request' => [
                                    'price' => '241',
                                    'old_price' => '241',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '209',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '240',
                                    'old_price' => '240',
                                ],
                                'super_express' => [
                                    'price' => '261',
                                    'old_price' => '261',
                                ],
                                'request' => [
                                    'price' => '282',
                                    'old_price' => '282',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '239',
                                    'old_price' => '239',
                                ],
                                'express' => [
                                    'price' => '274',
                                    'old_price' => '274',
                                ],
                                'super_express' => [
                                    'price' => '298',
                                    'old_price' => '298',
                                ],
                                'request' => [
                                    'price' => '322',
                                    'old_price' => '322',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '269',
                                    'old_price' => '269',
                                ],
                                'express' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'super_express' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                                'request' => [
                                    'price' => '363',
                                    'old_price' => '363',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '319',
                                    'old_price' => '319',
                                ],
                                'express' => [
                                    'price' => '366',
                                    'old_price' => '366',
                                ],
                                'super_express' => [
                                    'price' => '398',
                                    'old_price' => '398',
                                ],
                                'request' => [
                                    'price' => '430',
                                    'old_price' => '430',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '419',
                                    'old_price' => '419',
                                ],
                                'express' => [
                                    'price' => '481',
                                    'old_price' => '481',
                                ],
                                'super_express' => [
                                    'price' => '523',
                                    'old_price' => '523',
                                ],
                                'request' => [
                                    'price' => '565',
                                    'old_price' => '565',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '719',
                                    'old_price' => '719',
                                ],
                                'express' => [
                                    'price' => '826',
                                    'old_price' => '826',
                                ],
                                'super_express' => [
                                    'price' => '898',
                                    'old_price' => '898',
                                ],
                                'request' => [
                                    'price' => '970',
                                    'old_price' => '970',
                                ],
                            ],
                        ]
                    ],
                    'person_2' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => true,
                                'regular' => [
                                    'price' => '169',
                                    'old_price' => '169',
                                ],
                                'express' => [
                                    'price' => '194',
                                    'old_price' => '194',
                                ],
                                'super_express' => [
                                    'price' => '211',
                                    'old_price' => '211',
                                ],
                                'request' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '199',
                                    'old_price' => '199',
                                ],
                                'express' => [
                                    'price' => '228',
                                    'old_price' => '228',
                                ],
                                'super_express' => [
                                    'price' => '248',
                                    'old_price' => '248',
                                ],
                                'request' => [
                                    'price' => '268',
                                    'old_price' => '268',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '229',
                                    'old_price' => '229',
                                ],
                                'express' => [
                                    'price' => '263',
                                    'old_price' => '263',
                                ],
                                'super_express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'request' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '259',
                                    'old_price' => '259',
                                ],
                                'express' => [
                                    'price' => '297',
                                    'old_price' => '297',
                                ],
                                'super_express' => [
                                    'price' => '323',
                                    'old_price' => '323',
                                ],
                                'request' => [
                                    'price' => '349',
                                    'old_price' => '349',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '299',
                                    'old_price' => '299',
                                ],
                                'express' => [
                                    'price' => '343',
                                    'old_price' => '343',
                                ],
                                'super_express' => [
                                    'price' => '373',
                                    'old_price' => '373',
                                ],
                                'request' => [
                                    'price' => '403',
                                    'old_price' => '403',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '359',
                                    'old_price' => '359',
                                ],
                                'express' => [
                                    'price' => '412',
                                    'old_price' => '412',
                                ],
                                'super_express' => [
                                    'price' => '448',
                                    'old_price' => '448',
                                ],
                                'request' => [
                                    'price' => '484',
                                    'old_price' => '484',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '459',
                                    'old_price' => '459',
                                ],
                                'express' => [
                                    'price' => '527',
                                    'old_price' => '527',
                                ],
                                'super_express' => [
                                    'price' => '573',
                                    'old_price' => '573',
                                ],
                                'request' => [
                                    'price' => '619',
                                    'old_price' => '619',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '759',
                                    'old_price' => '759',
                                ],
                                'express' => [
                                    'price' => '872',
                                    'old_price' => '872',
                                ],
                                'super_express' => [
                                    'price' => '948',
                                    'old_price' => '948',
                                ],
                                'request' => [
                                    'price' => '1024',
                                    'old_price' => '1024',
                                ],
                            ],
                        ]
                    ],
                    'person_3' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => true,
                                'regular' => [
                                    'price' => '219',
                                    'old_price' => '219',
                                ],
                                'express' => [
                                    'price' => '251',
                                    'old_price' => '251',
                                ],
                                'super_express' => [
                                    'price' => '273',
                                    'old_price' => '273',
                                ],
                                'request' => [
                                    'price' => '295',
                                    'old_price' => '295',
                                ],
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '249',
                                    'old_price' => '249',
                                ],
                                'express' => [
                                    'price' => '286',
                                    'old_price' => '286',
                                ],
                                'super_express' => [
                                    'price' => '311',
                                    'old_price' => '311',
                                ],
                                'request' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '279',
                                    'old_price' => '279',
                                ],
                                'express' => [
                                    'price' => '320',
                                    'old_price' => '320',
                                ],
                                'super_express' => [
                                    'price' => '348',
                                    'old_price' => '348',
                                ],
                                'request' => [
                                    'price' => '376',
                                    'old_price' => '376',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '329',
                                    'old_price' => '329',
                                ],
                                'express' => [
                                    'price' => '378',
                                    'old_price' => '378',
                                ],
                                'super_express' => [
                                    'price' => '411',
                                    'old_price' => '411',
                                ],
                                'request' => [
                                    'price' => '444',
                                    'old_price' => '444',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '399',
                                    'old_price' => '399',
                                ],
                                'express' => [
                                    'price' => '458',
                                    'old_price' => '458',
                                ],
                                'super_express' => [
                                    'price' => '498',
                                    'old_price' => '498',
                                ],
                                'request' => [
                                    'price' => '538',
                                    'old_price' => '538',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '499',
                                    'old_price' => '499',
                                ],
                                'express' => [
                                    'price' => '573',
                                    'old_price' => '573',
                                ],
                                'super_express' => [
                                    'price' => '623',
                                    'old_price' => '623',
                                ],
                                'request' => [
                                    'price' => '673',
                                    'old_price' => '673',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '799',
                                    'old_price' => '799',
                                ],
                                'express' => [
                                    'price' => '918',
                                    'old_price' => '918',
                                ],
                                'super_express' => [
                                    'price' => '998',
                                    'old_price' => '998',
                                ],
                                'request' => [
                                    'price' => '1074',
                                    'old_price' => '1074',
                                ],
                            ],
                        ]
                    ],
                    'person_4' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => true,
                                'regular' => [
                                    'price' => '269',
                                    'old_price' => '269',
                                ],
                                'express' => [
                                    'price' => '309',
                                    'old_price' => '309',
                                ],
                                'super_express' => [
                                    'price' => '336',
                                    'old_price' => '336',
                                ],
                                'request' => [
                                    'price' => '363',
                                    'old_price' => '363',
                                ],
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => true,
                                'regular' => [
                                    'price' => '299',
                                    'old_price' => '299',
                                ],
                                'express' => [
                                    'price' => '343',
                                    'old_price' => '343',
                                ],
                                'super_express' => [
                                    'price' => '373',
                                    'old_price' => '373',
                                ],
                                'request' => [
                                    'price' => '403',
                                    'old_price' => '403',
                                ],
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '359',
                                    'old_price' => '359',
                                ],
                                'express' => [
                                    'price' => '412',
                                    'old_price' => '412',
                                ],
                                'super_express' => [
                                    'price' => '448',
                                    'old_price' => '448',
                                ],
                                'request' => [
                                    'price' => '484',
                                    'old_price' => '484',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '439',
                                    'old_price' => '439',
                                ],
                                'express' => [
                                    'price' => '504',
                                    'old_price' => '504',
                                ],
                                'super_express' => [
                                    'price' => '548',
                                    'old_price' => '548',
                                ],
                                'request' => [
                                    'price' => '592',
                                    'old_price' => '592',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '539',
                                    'old_price' => '539',
                                ],
                                'express' => [
                                    'price' => '619',
                                    'old_price' => '619',
                                ],
                                'super_express' => [
                                    'price' => '673',
                                    'old_price' => '673',
                                ],
                                'request' => [
                                    'price' => '727',
                                    'old_price' => '727',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '839',
                                    'old_price' => '839',
                                ],
                                'express' => [
                                    'price' => '964',
                                    'old_price' => '964',
                                ],
                                'super_express' => [
                                    'price' => '1048',
                                    'old_price' => '1048',
                                ],
                                'request' => [
                                    'price' => '1132',
                                    'old_price' => '1132',
                                ],
                            ],
                        ]
                    ],
                    'person_5' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => true,
                                'regular' => [
                                    'price' => '389',
                                    'old_price' => '389',
                                ],
                                'express' => [
                                    'price' => '447',
                                    'old_price' => '447',
                                ],
                                'super_express' => [
                                    'price' => '486',
                                    'old_price' => '486',
                                ],
                                'request' => [
                                    'price' => '525',
                                    'old_price' => '525',
                                ],
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '479',
                                    'old_price' => '479',
                                ],
                                'express' => [
                                    'price' => '550',
                                    'old_price' => '550',
                                ],
                                'super_express' => [
                                    'price' => '598',
                                    'old_price' => '598',
                                ],
                                'request' => [
                                    'price' => '646',
                                    'old_price' => '646',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '579',
                                    'old_price' => '579',
                                ],
                                'express' => [
                                    'price' => '665',
                                    'old_price' => '665',
                                ],
                                'super_express' => [
                                    'price' => '723',
                                    'old_price' => '723',
                                ],
                                'request' => [
                                    'price' => '781',
                                    'old_price' => '781',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '879',
                                    'old_price' => '879',
                                ],
                                'express' => [
                                    'price' => '1010',
                                    'old_price' => '1010',
                                ],
                                'super_express' => [
                                    'price' => '1098',
                                    'old_price' => '1098',
                                ],
                                'request' => [
                                    'price' => '1186',
                                    'old_price' => '1186',
                                ],
                            ],
                        ]
                    ],
                    'person_6' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => true,
                                'regular' => [
                                    'price' => '519',
                                    'old_price' => '519',
                                ],
                                'express' => [
                                    'price' => '596',
                                    'old_price' => '596',
                                ],
                                'super_express' => [
                                    'price' => '648',
                                    'old_price' => '648',
                                ],
                                'request' => [
                                    'price' => '700',
                                    'old_price' => '700',
                                ],
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '619',
                                    'old_price' => '619',
                                ],
                                'express' => [
                                    'price' => '711',
                                    'old_price' => '711',
                                ],
                                'super_express' => [
                                    'price' => '773',
                                    'old_price' => '773',
                                ],
                                'request' => [
                                    'price' => '835',
                                    'old_price' => '835',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '919',
                                    'old_price' => '919',
                                ],
                                'express' => [
                                    'price' => '1056',
                                    'old_price' => '1056',
                                ],
                                'super_express' => [
                                    'price' => '1148',
                                    'old_price' => '1148',
                                ],
                                'request' => [
                                    'price' => '1240',
                                    'old_price' => '1240',
                                ],
                            ],
                        ]
                    ],
                    'person_7' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '659',
                                    'old_price' => '659',
                                ],
                                'express' => [
                                    'price' => '757',
                                    'old_price' => '757',
                                ],
                                'super_express' => [
                                    'price' => '823',
                                    'old_price' => '823',
                                ],
                                'request' => [
                                    'price' => '889',
                                    'old_price' => '889',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '959',
                                    'old_price' => '959',
                                ],
                                'express' => [
                                    'price' => '1102',
                                    'old_price' => '1102',
                                ],
                                'super_express' => [
                                    'price' => '1198',
                                    'old_price' => '1198',
                                ],
                                'request' => [
                                    'price' => '1294',
                                    'old_price' => '1294',
                                ],
                            ],
                        ]
                    ],
                    'person_8' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '699',
                                    'old_price' => '699',
                                ],
                                'express' => [
                                    'price' => '803',
                                    'old_price' => '803',
                                ],
                                'super_express' => [
                                    'price' => '873',
                                    'old_price' => '873',
                                ],
                                'request' => [
                                    'price' => '943',
                                    'old_price' => '943',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '999',
                                    'old_price' => '999',
                                ],
                                'express' => [
                                    'price' => '1148',
                                    'old_price' => '1148',
                                ],
                                'super_express' => [
                                    'price' => '1248',
                                    'old_price' => '1248',
                                ],
                                'request' => [
                                    'price' => '1348',
                                    'old_price' => '1348',
                                ],
                            ],
                        ]
                    ],
                    'person_9' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => true,
                                'regular' => [
                                    'price' => '739',
                                    'old_price' => '739',
                                ],
                                'express' => [
                                    'price' => '849',
                                    'old_price' => '849',
                                ],
                                'super_express' => [
                                    'price' => '923',
                                    'old_price' => '923',
                                ],
                                'request' => [
                                    'price' => '997',
                                    'old_price' => '997',
                                ],
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1039',
                                    'old_price' => '1039',
                                ],
                                'express' => [
                                    'price' => '1194',
                                    'old_price' => '1194',
                                ],
                                'super_express' => [
                                    'price' => '1298',
                                    'old_price' => '1298',
                                ],
                                'request' => [
                                    'price' => '1402',
                                    'old_price' => '1402',
                                ],
                            ],
                        ]
                    ],
                    'person_10' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1079',
                                    'old_price' => '1079',
                                ],
                                'express' => [
                                    'price' => '1240',
                                    'old_price' => '1240',
                                ],
                                'super_express' => [
                                    'price' => '1348',
                                    'old_price' => '1348',
                                ],
                                'request' => [
                                    'price' => '1456',
                                    'old_price' => '1456',
                                ],
                            ],
                        ]
                    ],
                    'person_11' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1119',
                                    'old_price' => '1119',
                                ],
                                'express' => [
                                    'price' => '1286',
                                    'old_price' => '1286',
                                ],
                                'super_express' => [
                                    'price' => '1398',
                                    'old_price' => '1398',
                                ],
                                'request' => [
                                    'price' => '1510',
                                    'old_price' => '1510',
                                ],
                            ],
                        ]
                    ],
                    'person_12' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1159',
                                    'old_price' => '1159',
                                ],
                                'express' => [
                                    'price' => '1332',
                                    'old_price' => '1332',
                                ],
                                'super_express' => [
                                    'price' => '1448',
                                    'old_price' => '1448',
                                ],
                                'request' => [
                                    'price' => '1564',
                                    'old_price' => '1564',
                                ],
                            ],
                        ]
                    ],
                    'person_13' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1199',
                                    'old_price' => '1199',
                                ],
                                'express' => [
                                    'price' => '1378',
                                    'old_price' => '1378',
                                ],
                                'super_express' => [
                                    'price' => '1498',
                                    'old_price' => '1498',
                                ],
                                'request' => [
                                    'price' => '1618',
                                    'old_price' => '1618',
                                ],
                            ],
                        ]
                    ],
                    'person_14' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1239',
                                    'old_price' => '1239',
                                ],
                                'express' => [
                                    'price' => '1424',
                                    'old_price' => '1424',
                                ],
                                'super_express' => [
                                    'price' => '1548',
                                    'old_price' => '1548',
                                ],
                                'request' => [
                                    'price' => '1672',
                                    'old_price' => '1672',
                                ],
                            ],
                        ]
                    ],
                    'person_15' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1279',
                                    'old_price' => '1279',
                                ],
                                'express' => [
                                    'price' => '1470',
                                    'old_price' => '1470',
                                ],
                                'super_express' => [
                                    'price' => '1598',
                                    'old_price' => '1598',
                                ],
                                'request' => [
                                    'price' => '1726',
                                    'old_price' => '1726',
                                ],
                            ],
                        ]
                    ],
                    'person_16' => [
                        'sizes' => [
                            '25-35' => [
                                'label' => '25 × 35 cm',
                                'label_inch' => '10" x 14"',
                                'available' => false,
                            ],
                            '30-40' => [
                                'label' => '30 x 40 cm',
                                'label_inch' => '12" x 16"',
                                'available' => false,
                            ],
                            '35-50' => [
                                'label' => '35 x 50 cm',
                                'label_inch' => '14" x 20"',
                                'available' => false,
                            ],
                            '40-60' => [
                                'label' => '40 x 60 cm',
                                'label_inch' => '16" x 24"',
                                'available' => false,
                            ],
                            '50-70' => [
                                'label' => '50 x 70 cm',
                                'label_inch' => '20" x 28"',
                                'available' => false,
                            ],
                            '60-80' => [
                                'label' => '60 x 80 cm',
                                'label_inch' => '24" x 31"',
                                'available' => false,
                            ],
                            '70-100' => [
                                'label' => '70 x 100 cm',
                                'label_inch' => '28" x 39"',
                                'available' => false,
                            ],
                            '90-120' => [
                                'label' => '90 x 120 cm',
                                'label_inch' => '35" x 47"',
                                'available' => false,
                            ],
                            '120-180' => [
                                'label' => '120 x 180 cm',
                                'label_inch' => '47" x 71"',
                                'available' => true,
                                'regular' => [
                                    'price' => '1319',
                                    'old_price' => '1319',
                                ],
                                'express' => [
                                    'price' => '1516',
                                    'old_price' => '1516',
                                ],
                                'super_express' => [
                                    'price' => '1648',
                                    'old_price' => '1648',
                                ],
                                'request' => [
                                    'price' => '1780',
                                    'old_price' => '1780',
                                ],
                            ],
                        ]
                    ],
                ],
            ]
        ],
        'sizes' => [
            'charcoal' => [
                '14.8-21' => [
                    'label' => '14,8 cm x 21 cm (A5)',
                    'label_inch' => '6" x 8"',
                    'label_width' => '14,8',
                    'label_height' => '21',
                    'label_width_inch' => '6"',
                    'label_height_inch' => '8"',
                    'max_subjects' => '1',
                ],
                '21-29.7' => [
                    'label' => '21 cm x 29,7 cm (A4)',
                    'label_inch' => '8" x 12"',
                    'label_width' => '21',
                    'label_height' => '29,7',
                    'label_width_inch' => '8"',
                    'label_height_inch' => '12"',
                    'max_subjects' => '1',
                ],
                '25-35' => [
                    'label' => '25 × 35 cm',
                    'label_inch' => '10" x 14"',
                    'label_width' => '25',
                    'label_height' => '35',
                    'label_width_inch' => '10"',
                    'label_height_inch' => '14"',
                    'max_subjects' => '2',
                ],
                '29.7-42' => [
                    'label' => '29,7 x 42 cm (A3)',
                    'label_inch' => '12" x 17"',
                    'label_width' => '29,7',
                    'label_height' => '42',
                    'label_width_inch' => '12"',
                    'label_height_inch' => '17"',
                    'max_subjects' => '3',
                ],
                '35-50' => [
                    'label' => '35 x 50 cm',
                    'label_inch' => '14" x 20"',
                    'label_width' => '35',
                    'label_height' => '50',
                    'label_width_inch' => '14"',
                    'label_height_inch' => '20"',
                    'max_subjects' => '4',
                ],
                '42-59.4' => [
                    'label' => '42 x 59,4 cm (A2)',
                    'label_inch' => '17" x 23"',
                    'label_width' => '42',
                    'label_height' => '59,4',
                    'label_width_inch' => '17"',
                    'label_height_inch' => '23"',
                    'max_subjects' => '4',
                ],
                '50-70' => [
                    'label' => '50 x 70 cm',
                    'label_inch' => '20" x 28"',
                    'label_width' => '50',
                    'label_height' => '70',
                    'label_width_inch' => '20"',
                    'label_height_inch' => '28"',
                    'max_subjects' => '5',
                ],
                '59.4-84.1' => [
                    'label' => '59,4 cm x 84,1 cm (A1)',
                    'label_inch' => '23" x 33"',
                    'label_width' => '59,4',
                    'label_height' => '84,1',
                    'label_width_inch' => '23"',
                    'label_height_inch' => '33"',
                    'max_subjects' => '6',
                ],
                '70-100' => [
                    'label' => '70 x 100 cm',
                    'label_inch' => '28" x 39"',
                    'label_width' => '70',
                    'label_height' => '100',
                    'label_width_inch' => '28"',
                    'label_height_inch' => '39"',
                    'max_subjects' => '7',
                ],
            ],
            'oil' => [
                '25-35' => [
                    'label' => '25 × 35 cm',
                    'label_inch' => '10" x 14"',
                    'label_width' => '25',
                    'label_height' => '35',
                    'label_width_inch' => '10"',
                    'label_height_inch' => '14"',
                    'max_subjects' => '1',
                ],
                '30-40' => [
                    'label' => '30 x 40 cm',
                    'label_inch' => '12" x 16"',
                    'label_width' => '30',
                    'label_height' => '40',
                    'label_width_inch' => '12"',
                    'label_height_inch' => '16"',
                    'max_subjects' => '2',
                ],
                '35-50' => [
                    'label' => '35 x 50 cm',
                    'label_inch' => '14" x 20"',
                    'label_width' => '35',
                    'label_height' => '50',
                    'label_width_inch' => '14"',
                    'label_height_inch' => '20"',
                    'max_subjects' => '3',
                ],
                '40-60' => [
                    'label' => '40 x 60 cm',
                    'label_inch' => '16" x 24"',
                    'label_width' => '40',
                    'label_height' => '60',
                    'label_width_inch' => '16"',
                    'label_height_inch' => '24"',
                    'max_subjects' => '4',
                ],
                '50-70' => [
                    'label' => '50 x 70 cm',
                    'label_inch' => '20" x 28"',
                    'label_width' => '50',
                    'label_height' => '70',
                    'label_width_inch' => '20"',
                    'label_height_inch' => '28"',
                    'max_subjects' => '4',
                ],
                '60-80' => [
                    'label' => '60 x 80 cm',
                    'label_inch' => '24" x 31"',
                    'label_width' => '60',
                    'label_height' => '80',
                    'label_width_inch' => '24"',
                    'label_height_inch' => '31"',
                    'max_subjects' => '5',
                ],
                '70-100' => [
                    'label' => '70 x 100 cm',
                    'label_inch' => '28" x 39"',
                    'label_width' => '70',
                    'label_height' => '100',
                    'label_width_inch' => '28"',
                    'label_height_inch' => '39"',
                    'max_subjects' => '6',
                ],
                '90-120' => [
                    'label' => '90 x 120 cm',
                    'label_inch' => '35" x 47"',
                    'label_width' => '90',
                    'label_height' => '120',
                    'label_width_inch' => '35"',
                    'label_height_inch' => '47"',
                    'max_subjects' => '9',
                ],
                '120-180' => [
                    'label' => '120 x 180 cm',
                    'label_inch' => '47" x 71"',
                    'label_width' => '120',
                    'label_height' => '180',
                    'label_width_inch' => '47"',
                    'label_height_inch' => '71"',
                    'max_subjects' => '16',
                ],
            ],
        ],
    ],
];

//get all prices
function getPrices() {
    global $prices;
    return $prices;
}

//get prices by locale, painting technique and subject
function getPricesByTechniqueSubject($locale = 'us', $painting_technique = 'oil', $subject = 'person_1') {
    global $prices;
    return isset($prices[$locale]['prices']['painting_technique'][$painting_technique][$subject]) ? $prices[$locale]['prices']['painting_technique'][$painting_technique][$subject] : null;
}
//get prices by locale, painting technique and subject
function getPriceByTechniqueSubjectSizeDuration($locale = 'us', $painting_technique = 'oil', $subject = 'person_1', $size = '25-35', $priceType = 'regular') {
    global $prices;
    return isset($prices[$locale]['prices']['painting_technique'][$painting_technique][$subject]['sizes'][$size][$priceType]['price']) ? $prices[$locale]['prices']['painting_technique'][$painting_technique][$subject]['sizes'][$size][$priceType]['price'] : 0;
}

//get sizes by locale, painting technique, subject and price type
function getSizesBySubjectTechnique($current_lang = 'us', $paintingTechnique = 'oil', $subject = 'person_1', $priceType = 'regular') {
    $allPricesData = getPrices();
    $data['sizes'] = $allPricesData[$current_lang]['sizes'][$paintingTechnique];
    if (!empty($data['sizes'])) {
        foreach($data['sizes'] as $size => $item) {
            $item['available'] = false;
            $price = isset($allPricesData[$current_lang]['prices']['painting_technique'][$paintingTechnique][$subject]['sizes'][$size][$priceType]) ? $allPricesData[$current_lang]['prices']['painting_technique'][$paintingTechnique][$subject]['sizes'][$size][$priceType]['price'] : null;
            if (isset($allPricesData[$current_lang]['prices']['painting_technique'][$paintingTechnique][$subject]['sizes'][$size][$priceType])) {
                $data['sizes'][$size] = array_merge($item, $allPricesData[$current_lang]['prices']['painting_technique'][$paintingTechnique][$subject]['sizes'][$size], ['price' => $price]);
            } else {
                $data['sizes'][$size] = $item;
            }
        }
    }
    return $data['sizes'];
}

//duration settings
function getDuration() {
    $duration = [
        'all_locales' => [
            'durations' => [
                'types' => [
                    'regular' => pll__('Normal'),
                    'express' => pll__('Express Service'),
                    'super_express' => pll__('Super Express Service'),
                    'request' => pll__('Request'),
                ],
                'types_percents' => [
                    'regular' => pll__('For Free'),
                    'express' => pll__('15% Extra'),
                    'super_express' => pll__('30% Extra'),
                    'request' => pll__('50% Extra'),
                ],
                'types_count' => [
                    'regular' => 100,
                    'express' => 1,
                    'super_express' => 2,
                    'request' => 3,
                ],
                'types_calendar_style' => [
                    'regular' => 'calendar_style_1',
                    'express' => 'calendar_style_2',
                    'super_express' => 'calendar_style_3',
                    'request' => 'calendar_style_4',
                ],
                'painting_technique' => [
                    'medium_oil_portraits' => [
                        'painting_technique' => 'oil',
                        'label' => pll__('Medium oil portraits'),
                        'sub_label' => '25x35 cm - 40x60 cm',
                        'sub_label_inch' => '10"x14" - 16"x24"',
                        'sizes' => [
                            '25-35',
                            '30-40',
                            '35-50',
                            '40-60',
                        ],
                        'regular' => [
                            'label' => '19 ' . pll__('days'),
                            'duration_range' => [19],
                            'count' => 30,
                        ],
                        'express' => [
                            'label' => '16 ' . pll__('days'),
                            'duration_range' => [16],
                            'count' => 3,
                        ],
                        'super_express' => [
                            'label' => '13 ' . pll__('days'),
                            'duration_range' => [13],
                            'count' => 3,
                        ],
                        'request' => [
                            'label' => '9-11 ' . pll__('days'),
                            'duration_range' => [9, 11],
                            'count' => 4,
                        ],
                    ],
                    'large_oil_portraits' => [
                        'painting_technique' => 'oil',
                        'label' => pll__('Large oil portraits'),
                        'sub_label' => '50x70 cm - 120x180 cm',
                        'sub_label_inch' => '20"x28" - 47"x71"',
                        'sizes' => [
                            '50-70',
                            '60-80',
                            '70-100',
                            '90-120',
                            '120-180',
                        ],
                        'regular' => [
                            'label' => '21 ' . pll__('days'),
                            'duration_range' => [21],
                            'count' => 30,
                        ],
                        'express' => [
                            'label' => '18 ' . pll__('days'),
                            'duration_range' => [18],
                            'count' => 3,
                        ],
                        'super_express' => [
                            'label' => '15 ' . pll__('days'),
                            'duration_range' => [15],
                            'count' => 3,
                        ],
                        'request' => [
                            'label' => '11-14 ' . pll__('days'),
                            'duration_range' => [11, 14],
                            'count' => 4,
                        ],
                    ],
                    'charcoal' => [
                        'painting_technique' => 'charcoal',
                        'label' => pll__('Charcoal'),
                        'sub_label' => pll__('all sizes'),
                        'sub_label_inch' => pll__('all sizes'),
                        'sizes' => [],
                        'regular' => [
                            'label' => '14 ' . pll__('days'),
                            'duration_range' => [14],
                            'count' => 30,
                        ],
                        'express' => [
                            'label' => '11 ' . pll__('days'),
                            'duration_range' => [11],
                            'count' => 3,
                        ],
                        'super_express' => [
                            'label' => '9 ' . pll__('days'),
                            'duration_range' => [9],
                            'count' => 2,
                        ],
                        'request' => [
                            'label' => '5-7 ' . pll__('days'),
                            'duration_range' => [5, 7],
                            'count' => 4,
                        ],
                    ],
                ]
            ]
        ]
    ];
    return $duration;
}

//duration based on painting technique and size
function getDurationWithDates($paintingTechnique = 'oil', $size = '25-35') {
    $duration = getDuration();
    $paintingTechniqueData = null;
    foreach($duration['all_locales']['durations']['painting_technique'] as $painting_technique_key => $painting_technique_item) {
        if ($painting_technique_item['painting_technique'] == $paintingTechnique) {
            if ($paintingTechnique == 'oil') {
                if (in_array($size, $painting_technique_item['sizes'])) {
                    $paintingTechniqueData = $painting_technique_item;
                    break;
                }
            } else {
                $paintingTechniqueData = $painting_technique_item;
                break;
            }
        }
    }
    if ($paintingTechniqueData) {
        $typesAll = array_keys($duration['all_locales']['durations']['types']);
        foreach($typesAll as $type) {
            $paintingTechniqueData[$type]['type_label'] = $duration['all_locales']['durations']['types'][$type];
            $paintingTechniqueData[$type]['type_percent_label'] = $duration['all_locales']['durations']['types_percents'][$type];
            $paintingTechniqueData[$type]['type_calendar_style'] = $duration['all_locales']['durations']['types_calendar_style'][$type];
            $paintingTechniqueData[$type]['type_date_from'] = date("Y-m-d");
            $durationFrom = isset($paintingTechniqueData[$type]['duration_range'][0]) ? $paintingTechniqueData[$type]['duration_range'][0] : 20;
            $paintingTechniqueData[$type]['type_count'] = isset($paintingTechniqueData[$type]['count']) ? $paintingTechniqueData[$type]['count'] : $duration['all_locales']['durations']['types_count'][$type];

            if ($durationFrom) {
                $paintingTechniqueData[$type]['type_date_from'] = date("Y-m-d", strtotime('+' . $durationFrom . 'days'));
                /*$dayN = date("N", strtotime($paintingTechniqueData[$type]['type_date_from']));
                if ($dayN > 5) {
                    while (1) {
                        $paintingTechniqueData[$type]['type_date_from'] = date("Y-m-d", strtotime($paintingTechniqueData[$type]['type_date_from'] . ' +1 day'));
                        $dayN = date("N", strtotime($paintingTechniqueData[$type]['type_date_from']));
                        if ($dayN < 6) {
                            break;
                        }
                    }
                }*/
            }
            $paintingTechniqueData[$type]['type_date'] = pll__(date("l", strtotime($paintingTechniqueData[$type]['type_date_from']))) . ', ' . date("d.m Y", strtotime($paintingTechniqueData[$type]['type_date_from']));
            $paintingTechniqueData['types'][$type] = $paintingTechniqueData[$type];
        }
    }
    return $paintingTechniqueData;
}

//Subjects Settings
function getSubjects() {
    $subjects = [
        'person_1' => [
            'price_type' => 'person_1',
            'label' => pll__('1 person'),
            'icon' => '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32.8187 27.7252C32.7391 27.7119 32.6589 27.7088 32.5798 27.7161C32.4702 27.7132 28.875 27.7115 28.875 27.7115V25.4927C31.6793 23.8239 33.5625 20.7626 33.5625 17.2693V9.79744C34.0605 8.88862 34.3442 7.84641 34.3442 6.73903V0.9375C34.3442 0.419813 33.9245 0 33.4067 0H19.9531C16.3432 0 13.4062 2.93691 13.4062 6.54684V8.45316C13.4062 9.55875 13.7931 10.5753 14.4375 11.3762V17.2693C14.4375 20.7626 16.3208 23.8239 19.125 25.4927V27.7115C19.125 27.7115 15.5303 27.7132 15.4209 27.7161C15.3414 27.7087 15.2608 27.7118 15.1808 27.7253C8.72381 28.0236 3.5625 33.3696 3.5625 39.899V47.0625C3.5625 47.5802 3.98222 48 4.5 48H43.5C44.0178 48 44.4375 47.5802 44.4375 47.0625V39.899C44.4375 33.3694 39.2758 28.0233 32.8187 27.7252ZM15.2812 8.45316V6.54684C15.2812 3.97078 17.377 1.875 19.9531 1.875H32.4691V3.75H25.3594C24.8416 3.75 24.4219 4.16981 24.4219 4.6875C24.4219 5.20519 24.8416 5.625 25.3594 5.625H32.4692V6.73903C32.4692 9.22641 30.4456 11.25 27.9582 11.25H18.0781C16.5359 11.25 15.2812 9.99534 15.2812 8.45316ZM16.3125 17.2693V12.7775C16.8576 13.0009 17.4535 13.125 18.0781 13.125H27.9581C29.3495 13.125 30.6373 12.6764 31.6874 11.9181V17.2693C31.6874 21.5082 28.2388 24.9568 23.9999 24.9568C19.761 24.9568 16.3125 21.5082 16.3125 17.2693ZM27 26.3493V27.774C27 29.4282 25.6542 30.774 24 30.774C22.3458 30.774 21 29.4282 21 27.774V26.3493C21.944 26.6619 22.9524 26.8318 24 26.8318C25.0476 26.8318 26.056 26.6619 27 26.3493ZM19.4758 29.5865C20.1967 31.3793 21.9523 32.649 24 32.649C26.0477 32.649 27.8033 31.3793 28.5242 29.5865H31.0407L24 41.7813L16.9593 29.5865H19.4758ZM42.5625 46.125H39.1875V41.625C39.1875 41.1073 38.7678 40.6875 38.25 40.6875C37.7322 40.6875 37.3125 41.1073 37.3125 41.625V46.125H10.6875V38.6421C10.6875 38.1244 10.2678 37.7046 9.75 37.7046C9.23222 37.7046 8.8125 38.1244 8.8125 38.6421V46.125H5.4375V39.899C5.4375 34.5265 9.56728 30.1012 14.8188 29.6289L23.188 44.125C23.3555 44.4151 23.6649 44.5938 23.9999 44.5938C24.3349 44.5938 24.6443 44.4151 24.8118 44.125L33.181 29.6289C38.4327 30.1012 42.5625 34.5265 42.5625 39.899V46.125Z" fill="#F9AB97"/>
                            <path d="M21.4948 16.3645C21.3205 16.1902 21.0786 16.0898 20.832 16.0898C20.5855 16.0898 20.3436 16.1902 20.1692 16.3645C19.9948 16.5389 19.8945 16.7808 19.8945 17.0273C19.8945 17.2739 19.9948 17.5158 20.1692 17.6902C20.3436 17.8644 20.5855 17.9648 20.832 17.9648C21.0786 17.9648 21.3205 17.8645 21.4948 17.6902C21.6692 17.5158 21.7695 17.2739 21.7695 17.0273C21.7695 16.7808 21.6692 16.5389 21.4948 16.3645Z" fill="#F9AB97"/>
                            <path d="M27.8562 16.3645C27.6818 16.1902 27.4409 16.0898 27.1934 16.0898C26.9468 16.0898 26.7049 16.1902 26.5305 16.3645C26.3562 16.5389 26.2559 16.7808 26.2559 17.0273C26.2559 17.2739 26.3562 17.5158 26.5305 17.6902C26.7059 17.8645 26.9468 17.9648 27.1934 17.9648C27.4409 17.9648 27.6818 17.8645 27.8562 17.6902C28.0315 17.5158 28.1309 17.2739 28.1309 17.0273C28.1309 16.7808 28.0315 16.5389 27.8562 16.3645Z" fill="#F9AB97"/>
                            <path d="M22.3894 4.02469C22.215 3.85031 21.9731 3.75 21.7266 3.75C21.48 3.75 21.2381 3.85022 21.0637 4.02469C20.8894 4.19906 20.7891 4.44094 20.7891 4.6875C20.7891 4.93406 20.8894 5.17594 21.0637 5.35022C21.2381 5.52469 21.48 5.625 21.7266 5.625C21.9731 5.625 22.215 5.52469 22.3894 5.35022C22.5638 5.17594 22.6641 4.93406 22.6641 4.6875C22.6641 4.44094 22.5638 4.19906 22.3894 4.02469Z" fill="#F9AB97"/>
                            <path d="M25.4321 20.0772C25.066 19.7112 24.4724 19.7112 24.1062 20.0772C24.0228 20.1607 23.9254 20.173 23.8748 20.173C23.8242 20.173 23.7268 20.1606 23.6434 20.0772C23.2774 19.7112 22.6837 19.7112 22.3175 20.0772C21.9514 20.4433 21.9514 21.037 22.3175 21.4031C22.7469 21.8324 23.3108 22.0471 23.8748 22.0471C24.4388 22.0471 25.0027 21.8324 25.4321 21.4031C25.7982 21.037 25.7982 20.4433 25.4321 20.0772Z" fill="#F9AB97"/>
                            <path d="M38.9128 37.4173C38.7384 37.2429 38.4966 37.1426 38.25 37.1426C38.0034 37.1426 37.7616 37.2429 37.5872 37.4173C37.4128 37.5916 37.3125 37.8335 37.3125 38.0801C37.3125 38.3266 37.4128 38.5685 37.5872 38.7429C37.7616 38.9172 38.0034 39.0176 38.25 39.0176C38.4966 39.0176 38.7384 38.9173 38.9128 38.7429C39.0872 38.5685 39.1875 38.3266 39.1875 38.0801C39.1875 37.8335 39.0872 37.5916 38.9128 37.4173Z" fill="#F9AB97"/>
                        </svg>',
        ],
        'person_2' => [
            'price_type' => 'person_2',
            'label' => pll__('2 person'),
            'icon' => '<svg width="71" height="48" viewBox="0 0 71 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.9655 16.3645C17.7912 16.1902 17.5493 16.0898 17.3027 16.0898C17.0562 16.0898 16.8143 16.1902 16.6399 16.3645C16.4655 16.5389 16.3652 16.7808 16.3652 17.0273C16.3652 17.2739 16.4655 17.5158 16.6399 17.6902C16.8143 17.8644 17.0562 17.9648 17.3027 17.9648C17.5493 17.9648 17.7912 17.8645 17.9655 17.6902C18.1399 17.5158 18.2402 17.2739 18.2402 17.0273C18.2402 16.7808 18.1399 16.5389 17.9655 16.3645Z" fill="#F9AB97"/>
                            <path d="M24.3269 16.3645C24.1525 16.1902 23.9116 16.0898 23.6641 16.0898C23.4175 16.0898 23.1756 16.1902 23.0012 16.3645C22.8269 16.5389 22.7266 16.7808 22.7266 17.0273C22.7266 17.2739 22.8269 17.5158 23.0012 17.6902C23.1766 17.8645 23.4175 17.9648 23.6641 17.9648C23.9116 17.9648 24.1525 17.8645 24.3269 17.6902C24.5022 17.5158 24.6016 17.2739 24.6016 17.0273C24.6016 16.7808 24.5022 16.5389 24.3269 16.3645Z" fill="#F9AB97"/>
                            <path d="M18.8601 4.02469C18.6857 3.85031 18.4438 3.75 18.1973 3.75C17.9507 3.75 17.7088 3.85022 17.5345 4.02469C17.3601 4.19906 17.2598 4.44094 17.2598 4.6875C17.2598 4.93406 17.3601 5.17594 17.5345 5.35022C17.7088 5.52469 17.9507 5.625 18.1973 5.625C18.4438 5.625 18.6857 5.52469 18.8601 5.35022C19.0345 5.17594 19.1348 4.93406 19.1348 4.6875C19.1348 4.44094 19.0345 4.19906 18.8601 4.02469Z" fill="#F9AB97"/>
                            <path d="M21.9038 20.0772C21.5377 19.7112 20.9441 19.7112 20.5779 20.0772C20.4944 20.1607 20.3971 20.173 20.3465 20.173C20.2959 20.173 20.1985 20.1606 20.1151 20.0772C19.749 19.7112 19.1554 19.7112 18.7892 20.0772C18.4231 20.4433 18.4231 21.037 18.7892 21.4031C19.2186 21.8324 19.7825 22.0471 20.3465 22.0471C20.9105 22.0471 21.4744 21.8324 21.9038 21.4031C22.2699 21.037 22.2699 20.4433 21.9038 20.0772Z" fill="#F9AB97"/>
                            <path d="M49.4113 21.812C50.1629 21.812 50.9143 21.526 51.4866 20.9539C51.8527 20.5878 51.8527 19.9942 51.4866 19.6281C51.1206 19.262 50.5272 19.262 50.1607 19.6281C49.7476 20.0412 49.0751 20.0412 48.662 19.6281C48.2958 19.262 47.7022 19.262 47.3361 19.6281C46.97 19.9942 46.97 20.5878 47.3361 20.9539C47.9083 21.526 48.6597 21.812 49.4113 21.812Z" fill="#F9AB97"/>
                            <path d="M62.1347 28.0374L62.9091 26.9072C64.0849 25.1915 63.8707 22.8788 62.4 21.4082C61.7399 20.748 61.5124 19.7521 61.8202 18.8708C62.6143 16.5981 62.6687 14.1777 61.9775 11.8716L61.015 8.65997C60.2591 6.13819 58.7434 3.97444 56.6313 2.40253C54.5194 0.830813 52.0115 0 49.3788 0C46.7461 0 44.2382 0.830813 42.1263 2.40253C40.0143 3.97434 38.4984 6.13809 37.7425 8.65997L36.7799 11.8715C36.0887 14.1778 36.143 16.5981 36.9372 18.8708C37.2452 19.752 37.0175 20.748 36.3575 21.4081C34.8867 22.8787 34.6726 25.1915 35.8483 26.9072L36.6228 28.0374C31.9547 29.6396 28.5903 34.0729 28.5903 39.2775V47.0625C28.5903 47.5803 29.0101 48 29.5278 48H45.1651C45.6828 48 46.1026 47.5803 46.1026 47.0625C46.1026 46.5447 45.6828 46.125 45.1651 46.125H40.5921H37.9563V42.8233V39.5716C37.9563 39.0538 37.5365 38.6341 37.0188 38.6341C36.8898 38.6341 36.7669 38.6601 36.6551 38.7073C36.318 38.8493 36.0813 39.1828 36.0813 39.5716V46.125H30.4654V39.2774C30.4654 33.7608 34.9535 29.2727 40.4701 29.2727H44.7488C45.0891 31.5224 47.0357 33.2523 49.3788 33.2523C51.7219 33.2523 53.6684 31.5224 54.0087 29.2727H58.2874C63.8041 29.2727 68.2922 33.7608 68.2922 39.2774V46.125H62.6763V39.5716C62.6763 39.0538 62.2564 38.6341 61.7388 38.6341C61.2211 38.6341 60.8013 39.0538 60.8013 39.5716V46.125H53.5924C53.0747 46.125 52.6549 46.5447 52.6549 47.0625C52.6549 47.5803 53.0747 48 53.5924 48H69.2297C69.7474 48 70.1672 47.5803 70.1672 47.0625V39.2774C70.1672 34.0729 66.8028 29.6396 62.1347 28.0374ZM42.8254 14.522H46.4615C48.0438 14.522 49.4798 13.8865 50.5302 12.8585C51.5169 13.9057 52.9042 14.522 54.3808 14.522H55.9323V17.7863C55.9323 21.3997 52.9925 24.3397 49.3789 24.3397C45.7653 24.3397 42.8255 21.3998 42.8255 17.7863L42.8254 14.522ZM49.3788 31.3773C47.8304 31.3773 46.5709 30.1177 46.5709 28.5693V25.7331C47.4497 26.0445 48.3947 26.2146 49.3788 26.2146C50.3629 26.2146 51.308 26.0444 52.1867 25.7331V28.5693C52.1867 30.1177 50.9271 31.3773 49.3788 31.3773ZM54.0617 27.3977V24.7905C56.3186 23.2766 57.8072 20.7022 57.8072 17.7863V13.5845C57.8072 13.0667 57.3874 12.647 56.8697 12.647H54.3807C53.3068 12.647 52.3065 12.1418 51.6664 11.3029C52.0597 10.5192 52.2826 9.63572 52.2826 8.70075C52.2826 8.18297 51.8628 7.76325 51.3451 7.76325C50.8274 7.76325 50.4076 8.18297 50.4076 8.70075C50.4076 10.8767 48.6373 12.647 46.4614 12.647H41.8878C41.3701 12.647 40.9503 13.0667 40.9503 13.5845V17.7863C40.9503 20.7022 42.4388 23.2766 44.6958 24.7905V27.3977H40.47C39.8209 27.3977 39.1839 27.4508 38.5628 27.5515L37.395 25.8473C36.7294 24.876 36.8506 23.5666 37.6833 22.734C38.8492 21.568 39.2511 19.8089 38.7072 18.2524C38.0444 16.3553 37.9989 14.335 38.576 12.4099L39.5386 9.19837C40.8515 4.818 44.806 1.875 49.3788 1.875C53.9515 1.875 57.9061 4.818 59.2189 9.19828L60.1816 12.4098C60.7585 14.3348 60.7131 16.3552 60.0503 18.2523C59.5064 19.8088 59.9083 21.5679 61.0743 22.7339C61.907 23.5665 62.0282 24.8759 61.3625 25.8473L60.1947 27.5514C59.5736 27.4507 58.9367 27.3976 58.2875 27.3976L54.0617 27.3977Z" fill="#F9AB97"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M29.2562 27.7252C29.1766 27.7119 29.0964 27.7088 29.0173 27.7161C28.9077 27.7132 25.3125 27.7115 25.3125 27.7115V25.4927C28.1168 23.8239 30 20.7626 30 17.2693V9.79744C30.498 8.88863 30.7817 7.84641 30.7817 6.73903V0.9375C30.7817 0.419813 30.362 0 29.8442 0H16.3906C12.7807 0 9.84375 2.93691 9.84375 6.54684V8.45316C9.84375 9.55875 10.2306 10.5753 10.875 11.3762V17.2693C10.875 20.7626 12.7583 23.8239 15.5625 25.4927V27.7115C15.5625 27.7115 11.9678 27.7132 11.8584 27.7161C11.7789 27.7088 11.6983 27.7118 11.6183 27.7252C5.16131 28.0236 0 33.3696 0 39.899V47.0625C0 47.5802 0.419719 48 0.9375 48H39.9375C40.4553 48 40.875 47.5802 40.875 47.0625L40.5921 46.125H39H35.625H33.75H7.125V38.6421C7.125 38.1244 6.70528 37.7046 6.1875 37.7046C5.66972 37.7046 5.25 38.1244 5.25 38.6421V46.125H1.875V39.899C1.875 34.5265 6.00478 30.1012 11.2563 29.6289L19.6255 44.125C19.793 44.4151 20.1024 44.5938 20.4374 44.5938C20.7724 44.5938 21.0818 44.4151 21.2493 44.125L29.6185 29.6289C32.7904 29.5865 34.3379 31.3773 34.3379 31.3773C34.8096 31.0103 35.3149 30.6846 35.8483 30.4056C35.8483 30.4056 34.2022 27.8824 29.2562 27.7252ZM37.9563 39.5716V42.8233L36.6551 38.7073C36.7669 38.6601 36.8898 38.6341 37.0188 38.6341C37.5365 38.6341 37.9563 39.0538 37.9563 39.5716ZM11.7188 8.45316V6.54684C11.7188 3.97078 13.8145 1.875 16.3906 1.875H28.9066V3.75H21.7969C21.2791 3.75 20.8594 4.16981 20.8594 4.6875C20.8594 5.20519 21.2791 5.625 21.7969 5.625H28.9067V6.73903C28.9067 9.22641 26.8831 11.25 24.3957 11.25H14.5156C12.9734 11.25 11.7188 9.99534 11.7188 8.45316ZM12.75 17.2693V12.7775C13.2951 13.0009 13.891 13.125 14.5156 13.125H24.3956C25.787 13.125 27.0748 12.6764 28.1249 11.9181V17.2693C28.1249 21.5082 24.6763 24.9568 20.4374 24.9568C16.1985 24.9568 12.75 21.5082 12.75 17.2693ZM23.4375 26.3493V27.774C23.4375 29.4282 22.0917 30.774 20.4375 30.774C18.7833 30.774 17.4375 29.4282 17.4375 27.774V26.3493C18.3815 26.6619 19.3899 26.8318 20.4375 26.8318C21.4851 26.8318 22.4935 26.6619 23.4375 26.3493ZM15.9133 29.5865C16.6342 31.3793 18.3898 32.649 20.4375 32.649C22.4852 32.649 24.2408 31.3793 24.9617 29.5865H27.4782L20.4375 41.7813L13.3968 29.5865H15.9133Z" fill="#F9AB97"/>
                        </svg>'
        ],
        'pet_1' => [
            'price_type' => 'person_1',
            'label' => pll__('1 pet'),
            'icon' => '<svg width="39" height="51" viewBox="0 0 39 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.0648 19.8378C13.5607 22.922 16.772 25.3514 22.5996 25.3514C27.8105 25.3514 31.2444 22.9592 32.964 19.8378M12.0648 19.8378C10.1472 15.8844 11.0481 10.855 12.8699 8.48649C12.3218 5.74336 12.3993 4.27949 13.1942 2C15.9438 2.46265 17.1968 3.21552 19.0321 5.24324H25.5185C28.5289 2.84284 29.8687 2.07225 31.6807 2C32.4961 4.93342 32.3812 6.23997 32.005 8.48649C34.6365 11.469 34.9904 16.1597 32.964 19.8378M12.0648 19.8378C9.71215 20.7779 8.16688 25.4437 7.63618 30.8649M12.0648 50C8.16575 47.7196 6.88523 38.536 7.63618 30.8649M12.0648 50C2.71517 49.6772 0.580092 46.6104 1.19401 36.7027M12.0648 50H15.4645M32.964 19.8378C39.4643 26 39.4643 48.0541 31.6807 50H29.4104M7.63618 30.8649V15.9459C7.63618 10.1081 1.19401 10.7568 1.19401 15.9459V23.4054M15.4645 50H22.5996M15.4645 50V45.4595M15.4645 33.7838V45.4595M22.5996 50H29.4104M22.5996 50V45.4595M22.5996 32.4865V45.4595M29.4104 50V45.4595M29.4104 33.7838V45.4595M15.4645 45.4595C16.1131 41.5676 21.951 41.5676 22.5996 45.4595M22.5996 45.4595C23.2483 41.5676 29.0861 41.8919 29.4104 45.4595" stroke="#F9AB97" stroke-width="2"/>
                        </svg>'
        ],
        'person_1_pet_1' => [
            'price_type' => 'person_2',
            'label' => pll__('1 person + 1 pet'),
            'icon' => '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6325 29.8434C12.8107 30.0572 13.0746 30.1808 13.3528 30.1808C13.6311 30.1808 13.8949 30.0573 14.073 29.8435L14.6338 29.1706C14.8667 28.8912 14.917 28.5022 14.7626 28.1727C14.6083 27.8433 14.2774 27.6328 13.9136 27.6328H12.792C12.4283 27.6328 12.0973 27.8432 11.943 28.1727C11.7887 28.5022 11.839 28.891 12.0717 29.1705L12.6325 29.8434Z" fill="#F9AB97"/>
                            <path d="M30.9051 18.2724C31.3824 18.2724 31.8597 18.0907 32.223 17.7274C32.5891 17.3613 32.589 16.7678 32.2229 16.4016C31.8595 16.0379 31.2718 16.0356 30.905 16.3937C30.5384 16.0354 29.9507 16.0382 29.5871 16.4015C29.221 16.7676 29.221 17.3612 29.5871 17.7274C29.9505 18.0908 30.4277 18.2724 30.9051 18.2724Z" fill="#F9AB97"/>
                            <path d="M46.2848 26.358C47.9682 23.3598 47.686 19.6373 45.5613 16.9237C46.5344 14.0927 45.8269 10.9703 43.6839 8.82731C43.3024 8.44575 42.8824 8.10413 42.4323 7.80909C41.5447 5.58319 40.0437 3.67697 38.0759 2.28103C35.9722 0.788719 33.4926 0 30.905 0C28.3174 0 25.8378 0.788719 23.7341 2.28103C21.7663 3.67697 20.2654 5.58319 19.3778 7.80909C18.9277 8.10413 18.5077 8.44575 18.1261 8.82731C15.983 10.9705 15.2754 14.0933 16.2489 16.9245C15.3871 18.0292 14.8079 19.3397 14.5668 20.7196L11.5091 20.7207C10.7784 20.0155 9.936 19.4573 8.99972 19.059C8.54297 18.8647 8.031 18.8903 7.59525 19.1293C7.15959 19.3684 6.86297 19.7862 6.78159 20.2756C6.67134 20.9378 6.64237 21.6158 6.69553 22.2904C6.72666 22.6853 6.786 23.0782 6.87272 23.4639C6.06216 24.6132 5.62069 25.9964 5.62069 27.4103C5.62069 27.4118 5.62078 27.4132 5.62078 27.4147C5.54184 25.934 4.3125 24.7536 2.8125 24.7536C1.26169 24.7536 0 26.0152 0 27.5661V32.1579C0 32.6756 0.419813 33.0954 0.9375 33.0954C1.45519 33.0954 1.875 32.6756 1.875 32.1579V27.5661C1.875 27.0491 2.29556 26.6286 2.8125 26.6286C3.32944 26.6286 3.75 27.0491 3.75 27.5661V42.6562C3.75 42.7236 3.75741 42.7891 3.77091 42.8524C3.87516 44.104 4.39059 45.2403 5.18269 46.125H4.6875C3.13669 46.125 1.875 44.8633 1.875 43.3125V40.5955C1.875 40.0778 1.45519 39.658 0.9375 39.658C0.419813 39.658 0 40.0778 0 40.5955V43.3125C0 45.8972 2.10281 48 4.6875 48H39.9033C44.3678 48 48 44.3678 48 39.9033V31.6924C48 29.7042 47.3638 27.862 46.2848 26.358ZM19.452 10.1532C19.8029 9.80222 20.1962 9.49584 20.621 9.24262C20.8051 9.13275 20.9461 8.96316 21.0203 8.76197C22.5403 4.64259 26.5127 1.875 30.905 1.875C35.2974 1.875 39.2698 4.64259 40.7898 8.76197C40.864 8.96316 41.005 9.13275 41.1892 9.24262C41.6138 9.49584 42.0072 9.80222 42.3581 10.1532C44.0954 11.8905 44.5933 14.4737 43.6265 16.7342C43.483 17.0697 43.5472 17.458 43.7911 17.7294C45.5648 19.7035 45.9766 22.4975 44.939 24.8592C43.3157 23.4061 41.1738 22.5211 38.8288 22.5211H34.8912V21.0573C36.8252 19.7658 38.1019 17.564 38.1019 15.069V11.5581C38.1019 11.0404 37.6821 10.6206 37.1644 10.6206H35.0846C34.2682 10.6206 33.5058 10.2507 32.9984 9.63244C33.3104 8.97909 33.4856 8.24831 33.4856 7.47731C33.4856 6.95963 33.0658 6.53981 32.5481 6.53981C32.0304 6.53981 31.6106 6.95963 31.6106 7.47731C31.6106 9.21047 30.2005 10.6205 28.4674 10.6205H24.6458C24.1282 10.6205 23.7083 11.0403 23.7083 11.558V15.0689C23.7083 17.5639 24.9851 19.7657 26.919 21.0573V22.5211H22.9813C21.9172 22.5211 20.8867 22.6989 19.9049 23.0497C19.9482 22.7982 19.9812 22.5447 20.0012 22.2904C20.0543 21.6158 20.0254 20.9379 19.9151 20.2759C19.8337 19.7863 19.5372 19.3685 19.1015 19.1294C18.6657 18.8903 18.1537 18.8647 17.6972 19.059C17.4211 19.1765 17.1543 19.3095 16.895 19.4544C17.1742 18.8317 17.5503 18.2513 18.019 17.7295C18.263 17.458 18.3271 17.0698 18.1837 16.7343C17.2168 14.4738 17.7146 11.8905 19.452 10.1532ZM25.5833 12.4955H28.4674C29.7765 12.4955 30.9696 11.9911 31.864 11.1671C32.709 12.005 33.861 12.4955 35.0846 12.4955H36.2269V15.0689C36.2269 18.0033 33.8395 20.3906 30.9051 20.3906C27.9707 20.3906 25.5833 18.0033 25.5833 15.0689V12.4955ZM28.794 21.9491C29.4619 22.1544 30.1707 22.2656 30.9051 22.2656C31.6394 22.2656 32.3483 22.1544 33.0162 21.9491V23.6491C33.0162 24.8132 32.0692 25.7603 30.9051 25.7603C29.7411 25.7603 28.794 24.8132 28.794 23.6491V21.9491ZM21.0812 41.8981C20.5111 42.5459 20.1643 43.3947 20.1643 44.3234C20.1643 44.4841 20.1758 44.642 20.1959 44.7972C19.6788 45.4083 18.9837 45.8348 18.2147 46.0202V38.5711C18.2147 38.0534 17.7949 37.6336 17.2772 37.6336C16.7595 37.6336 16.3397 38.0534 16.3397 38.5711V42.745C16.0208 42.6242 15.6757 42.5574 15.315 42.5574C14.9544 42.5574 14.6093 42.6241 14.2904 42.7449V37.9059C14.2904 37.3882 13.8706 36.9684 13.3529 36.9684C12.8352 36.9684 12.4154 37.3882 12.4154 37.9059V42.7449C12.0967 42.6241 11.7515 42.5574 11.3908 42.5574C11.0069 42.5574 10.6405 42.6331 10.3049 42.7692V38.571C10.3049 38.0533 9.88509 37.6335 9.36741 37.6335C8.84972 37.6335 8.42991 38.0533 8.42991 38.571V46.0058C6.82172 45.5895 5.62988 44.1282 5.62491 42.3928V36.2368C5.62725 34.5744 6.1515 32.9924 7.11947 31.6778C8.37506 33.2477 10.3047 34.2561 12.4666 34.2561H14.2391C16.4009 34.2561 18.3306 33.2478 19.5862 31.6779C20.5564 32.9954 21.0811 34.5813 21.0811 36.2482V41.8981H21.0812ZM8.62397 24.2572C8.84531 23.9877 8.89153 23.6275 8.76769 23.3184C8.66428 22.9356 8.59613 22.5406 8.56472 22.1431C8.53284 21.7376 8.53913 21.3308 8.58328 20.9298C9.27731 21.2704 9.89869 21.7303 10.4343 22.3003C10.6115 22.489 10.8587 22.5959 11.1175 22.5959H11.1179L15.5811 22.5941C15.8396 22.594 16.0868 22.4871 16.2638 22.2987C16.7989 21.7295 17.4198 21.27 18.1133 20.9297C18.1576 21.3307 18.1638 21.7374 18.1319 22.143C18.0982 22.5701 18.0218 22.9946 17.9048 23.4047C17.8205 23.7007 17.8867 24.0193 18.082 24.2572C18.8095 25.1425 19.2101 26.2624 19.2101 27.4103C19.2101 30.1512 16.9802 32.3812 14.2392 32.3812H12.4667C9.72572 32.3812 7.49569 30.1512 7.49569 27.4103C7.49569 26.2625 7.89647 25.1426 8.62397 24.2572ZM5.625 27.5799C5.64544 28.4132 5.81503 29.2097 6.10884 29.9441C5.93906 30.1387 5.77744 30.3386 5.625 30.5442V27.5799ZM10.3663 46.125V45.4571C10.3663 44.8922 10.8259 44.4325 11.3909 44.4325C11.9559 44.4325 12.4155 44.8921 12.4155 45.4571V46.125H10.3663ZM14.2905 45.4571C14.2905 44.8922 14.7502 44.4325 15.3152 44.4325C15.8802 44.4325 16.3398 44.8921 16.3398 45.4571V46.125H14.2906V45.4571H14.2905ZM22.0393 44.3234C22.0393 43.33 22.8475 42.5218 23.8409 42.5218H24.962V46.125H23.8409C22.8475 46.125 22.0393 45.3168 22.0393 44.3234ZM46.125 39.9033C46.125 43.334 43.334 46.125 39.9033 46.125H26.837V42.5218H39.4307C39.9484 42.5218 40.3682 42.102 40.3682 41.5843C40.3682 41.0666 39.9484 40.6468 39.4307 40.6468H23.8409C23.5359 40.6468 23.2398 40.6848 22.9562 40.7551V36.2483C22.9562 33.906 22.1228 31.692 20.5972 29.9439C20.9108 29.1596 21.0852 28.3052 21.0852 27.4103C21.0852 26.5117 20.9063 25.6257 20.5683 24.8041C21.3385 24.5334 22.1467 24.396 22.9812 24.396H26.9901C27.3408 26.238 28.9623 27.6352 30.9049 27.6352C32.8475 27.6352 34.469 26.2381 34.8198 24.396H38.8286C42.8518 24.396 46.1249 27.6691 46.1249 31.6923V39.9033H46.125Z" fill="#F9AB97"/>
                            <path d="M0.9375 37.3145C1.18406 37.3145 1.42594 37.2142 1.60022 37.0398C1.77459 36.8654 1.875 36.6235 1.875 36.377C1.875 36.1304 1.77469 35.8885 1.60022 35.7142C1.42594 35.5399 1.18406 35.4395 0.9375 35.4395C0.689906 35.4395 0.449062 35.5398 0.274687 35.7142C0.100219 35.8885 0 36.1295 0 36.377C0 36.6235 0.100219 36.8654 0.274687 37.0398C0.449156 37.2141 0.690938 37.3145 0.9375 37.3145Z" fill="#F9AB97"/>
                        </svg>'
        ],
        'landscape' => [
            'price_type' => 'person_1',
            'label' => pll__('Abstract / Landscape'),
            'icon' => '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M47.0624 46.1249H42.9375V38.7187C42.9375 38.2009 42.5176 37.7812 42 37.7812C41.4823 37.7812 41.0625 38.2009 41.0625 38.7187V46.1249H29.8125V28.3125C29.8125 27.7947 29.3927 27.375 28.875 27.375H19.125C18.6074 27.375 18.1876 27.7947 18.1876 28.3125V46.1249H6.93759V24.9374H7.29834C7.54697 24.9374 7.78537 24.8386 7.96125 24.6628L24 8.62401L40.0388 24.6628C40.2147 24.8386 40.4531 24.9374 40.7017 24.9374H41.0625V31.9686C41.0625 32.4864 41.4823 32.9061 42 32.9061C42.5176 32.9061 42.9375 32.4864 42.9375 31.9686V24.9374H47.0624C47.4417 24.9374 47.7835 24.7089 47.9286 24.3587C48.0737 24.0084 47.9934 23.6051 47.7253 23.337L24.6629 0.274569C24.2967 -0.0915231 23.7033 -0.0915231 23.337 0.274569L14.5246 9.08704C14.1585 9.45313 14.1585 10.0468 14.5246 10.4128C14.8908 10.779 15.4844 10.779 15.8505 10.4128L24 2.26328L44.799 23.0624H41.09L24.6629 6.6353C24.2967 6.2692 23.7033 6.2692 23.337 6.6353L6.90994 23.0624H3.20092L10.6005 15.6629C10.9666 15.2968 10.9666 14.7032 10.6005 14.337C10.2344 13.971 9.64077 13.9709 9.27459 14.337L0.27462 23.337C0.00659023 23.6051 -0.0737532 24.0083 0.0713712 24.3587C0.216496 24.709 0.558401 24.9374 0.937618 24.9374H5.0626V46.1248H0.937618C0.419932 46.1248 0.000121507 46.5445 0.000121507 47.0623C0.000121507 47.5801 0.419932 47.9998 0.937618 47.9998H6.0001H19.125H28.875H42H47.0624C47.5801 47.9998 47.9999 47.5801 47.9999 47.0623C47.9999 46.5445 47.5801 46.1249 47.0624 46.1249ZM27.9375 46.1249H20.0625V29.25H27.9375V46.1249Z" fill="#F9AB97"/>
                            <path d="M38.0625 27.375H32.8125C32.2948 27.375 31.875 27.7947 31.875 28.3125V37.6875C31.875 38.2052 32.2948 38.625 32.8125 38.625H38.0625C38.5802 38.625 39 38.2052 39 37.6875V28.3125C39 27.7947 38.5802 27.375 38.0625 27.375ZM37.125 36.75H33.75V29.25H37.125V36.75Z" fill="#F9AB97"/>
                            <path d="M15.1875 27.375H9.9375C9.41981 27.375 9 27.7947 9 28.3125V37.6875C9 38.2052 9.41981 38.625 9.9375 38.625H15.1875C15.7052 38.625 16.125 38.2052 16.125 37.6875V28.3125C16.125 27.7947 15.7052 27.375 15.1875 27.375ZM14.25 36.75H10.875V29.25H14.25V36.75Z" fill="#F9AB97"/>
                            <path d="M24 15.4043C21.6221 15.4043 19.6875 17.3389 19.6875 19.7168C19.6875 22.0947 21.6221 24.0293 24 24.0293C26.3779 24.0293 28.3125 22.0947 28.3125 19.7168C28.3125 17.3389 26.3779 15.4043 24 15.4043ZM24 22.1543C22.6559 22.1543 21.5625 21.0608 21.5625 19.7168C21.5625 18.3728 22.6559 17.2793 24 17.2793C25.3441 17.2793 26.4375 18.3728 26.4375 19.7168C26.4375 21.0608 25.3441 22.1543 24 22.1543Z" fill="#F9AB97"/>
                            <path d="M22.8815 37.0247C22.7072 36.8503 22.4652 36.75 22.2187 36.75C21.9722 36.75 21.7303 36.8503 21.5559 37.0247C21.3816 37.1991 21.2812 37.4409 21.2812 37.6875C21.2812 37.9341 21.3815 38.1759 21.5559 38.3503C21.7304 38.5247 21.9722 38.625 22.2187 38.625C22.4653 38.625 22.7072 38.5247 22.8815 38.3503C23.0558 38.1759 23.1562 37.9341 23.1562 37.6875C23.1562 37.4409 23.0559 37.1991 22.8815 37.0247Z" fill="#F9AB97"/>
                            <path d="M13.1315 11.8059C12.9572 11.6316 12.7153 11.5312 12.4687 11.5312C12.2222 11.5312 11.9803 11.6316 11.8059 11.8059C11.6316 11.9803 11.5312 12.2222 11.5312 12.4687C11.5312 12.7153 11.6315 12.9572 11.8059 13.1316C11.9804 13.3059 12.2222 13.4062 12.4687 13.4062C12.7153 13.4062 12.9572 13.3059 13.1315 13.1316C13.3058 12.9572 13.4062 12.7153 13.4062 12.4687C13.4062 12.2222 13.3059 11.9803 13.1315 11.8059Z" fill="#F9AB97"/>
                            <path d="M42.6627 34.4309C42.4884 34.2567 42.2465 34.1562 42 34.1562C41.7534 34.1562 41.5116 34.2566 41.3372 34.4309C41.1628 34.6062 41.0625 34.8472 41.0625 35.0937C41.0625 35.3403 41.1627 35.5822 41.3372 35.7575C41.5116 35.9319 41.7534 36.0312 42 36.0312C42.2466 36.0312 42.4884 35.9319 42.6627 35.7575C42.8371 35.5822 42.9375 35.3412 42.9375 35.0937C42.9375 34.8472 42.8372 34.6053 42.6627 34.4309Z" fill="#F9AB97"/>
                        </svg>'
        ],
        'custom' => [
            'price_type' => 'custom',
            'label' => pll__('Custom'),
            'icon' => '',
            'items' => [
                'persons' => [
                    'label' => pll__('Persons'),
                    'from' => 0,
                    'to' => 16,
                    'default' => 1,
                ],
                'pets' => [
                    'label' => pll__('Pets'),
                    'from' => 0,
                    'to' => 16,
                    'default' => 0,
                ],
            ],
            'max_items' => 16,
        ],
    ];
    return $subjects;
}


//Backgrounds Settings
function getBackgroundColorsSettings() {
    $backgrounds = [
        'beige' => [
            'label' => pll__('Beige'),
            'hex_color' => '#E8E1D8'
        ],
        'black' => [
            'label' => pll__('Black'),
            'hex_color' => '#3D3D3D'
        ],
        'blue_bronze' => [
            'label' => pll__('Blue Bronze'),
            'hex_color' => '#B1C4CA'
        ],
        'cold_blue' => [
            'label' => pll__('Cold Blue'),
            'hex_color' => '#60A3BF'
        ],
        'warm_green' => [
            'label' => pll__('Warm Green'),
            'hex_color' => '#8AB997'
        ],
        'white' => [
            'label' => pll__('White'),
            'hex_color' => '#ffffff'
        ],
    ];
    return $backgrounds;
}

//Discount Settings
function getDiscounts() {
    $discounts = [
        'usd' => [
            '20' => [
                'price_range' => [0, 190],
                'currency_symbol' => '$',
            ],
            '30' => [
                'price_range' => [191, 320],
                'currency_symbol' => '$',
            ],
            '40' => [
                'price_range' => [321, 1000000],
                'currency_symbol' => '$',
            ],
        ],
        'eur' => [
            '10' => [
                'price_range' => [0, 150],
                'currency_symbol' => '$',
            ],
            '20' => [
                'price_range' => [151, 280],
                'currency_symbol' => '$',
            ],
            '30' => [
                'price_range' => [281, 1000000],
                'currency_symbol' => '$',
            ],
        ],
    ];
    return $discounts;
}

//get discount data
function getDiscount($price = 0, $currency = 'usd') {
    $discount = null;
    $discounts = getDiscounts();
    $prices = isset($discounts[$currency]) ? $discounts[$currency] : [];
    
    if (!empty($prices)) {
        foreach($prices as $discountKey => $discountItem) {
            if ($discountItem['price_range'][0] <= $price && $price <= $discountItem['price_range'][1]) {
                $discount = [
                    'value' => $discountKey,
                    'currency_symbol' => $discountItem['currency_symbol'],
                    'label' => $discountItem['currency_symbol'] . ' ' . $discountKey,
                ];
                break;
            }
        }
    }
    return $discount;
}

//order preview image based on painting technique, subject and size
function getOrderPreviewImg($paintingTechnique = 'charcoal', $subject = 'person_1', $customSubject = [], $size = '25-35') {
    $imgPath = '/img/order_preview';
    if ($paintingTechnique && $subject && $size) {
        $availableFolders = [
            'charcoal_landscape','charcoal_person_1_pet_1',
            'charcoal_person_1','charcoal_person_2','charcoal_person_3','charcoal_person_4',
            'charcoal_pet_1','charcoal_pet_2','charcoal_pet_3',
            'oil_landscape','oil_person_1_pet_1','oil_person_1','oil_person_2','oil_person_3','oil_person_4','oil_pet_1',
        ];
        $imgPath .= '/' . $paintingTechnique;
        if ($subject != 'custom') {
            $imgPath.= '_' . $subject . '/';
        } else {
            $persons = isset($customSubject['persons']) ? $customSubject['persons'] : 1;
            $pets = isset($customSubject['pets']) ? $customSubject['pets'] : 0;
            if (!$persons && !$pets) {
                $persons = 1;
            }
            if ($paintingTechnique == 'oil') {
                if ($persons && $pets) {
                    $subject = 'person_1_pet_1';
                } else if ($persons) {
                    if (in_array($persons, ['1', '2', '3', '4'])) {
                        $subject = 'person_' . $persons;
                    } else {
                        $subject = 'person_1';
                    }
                } else if ($pets) {
                    if (in_array($pets, ['1'])) {
                        $subject = 'pet_' . $pets;
                    } else {
                        $subject = 'pet_1';
                    }
                }
            } else if ($paintingTechnique == 'charcoal') {
                if ($persons && $pets) {
                    $subject = 'person_1_pet_1';
                } else if ($persons) {
                    if (in_array($persons, ['1', '2', '3', '4'])) {
                        $subject = 'person_' . $persons;
                    } else {
                        $subject = 'person_1';
                    }
                } else if ($pets) {
                    if (in_array($pets, ['1', '2', '3'])) {
                        $subject = 'pet_' . $pets;
                    } else {
                        $subject = 'pet_1';
                    }
                }
            }
            $imgPath.= '_' . $subject . '/';
        }
        if ($size) {
            $imgPath .= $size . '.jpg';
        }
    } else {
        if (!$paintingTechnique) {
            $paintingTechnique = 'oil';
        }
        $imgPath .= '/default/' . $paintingTechnique . '.jpg';
    }
    $imgPath = the_theme_path() . $imgPath;
    return $imgPath;
}
