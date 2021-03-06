<?php

defined('TYPO3_MODE') || die();

if (!is_array($GLOBALS['TCA']['tt_content']['types']['dm_schema_faq'])) {
    $GLOBALS['TCA']['tt_content']['types']['dm_schema_faq'] = [];
}

$llFile = 'dm_schema/Resources/Private/Language/locallang_be.xlf';

/***************
 * Add content element to selector list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:'.$llFile.':dm_schema_faq.title',
        'dm_schema_faq',
        'content-special-html'
    ]
);

$GLOBALS['TCA']['tt_content']['palettes']['dm_schema_faq'] =
    [
        'showitem' => ' tx_dmschema_question,--linebreak--,
                        tx_dmschema_answer'
    ];

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['dm_schema_faq'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['dm_schema_faq'],
    [
        'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                --palette--;LLL:EXT:'.$llFile.':dm_schema.palette.dm_schema_faq;dm_schema_faq,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                --palette--;;hidden,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes, rowDescription,
        ',
        'columnsOverrides' => [
            'tx_dmschema_answer' => [
                'config' => [
                    'eval' => 'trim,required'
                ],
            ],
            'tx_dmschema_question' => [
                'config' => [
                    'eval' => 'trim,required'
                ],
            ]
        ]
    ]
);
