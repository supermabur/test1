<?php
   
return [
  
    'pagination_records' => 99999,
  
    'user_type' => ['User', 'Admin'],

    'dt_button' => 
        [  
            [
                'titleAttr' => 'Copy all data on Datatable',
                'extend' => 'copy',
                'className' => 'custom-btn copy',
                'text' => '...'
            ],
            [
                'titleAttr' => 'Download as PDF',
                'extend' => 'pdfHtml5',
                'className' => 'custom-btn pdf',
                'text' => '...'
            ],
            [
                'titleAttr' => 'Download as Excel',     
                'extend' => 'excelHtml5',
                'className' => 'custom-btn excel',
                'text' => '...'
            ],
            [
                'titleAttr' => 'Download as CSV',     
                'extend' => 'csvHtml5',
                'className' => 'custom-btn csv',
                'text' => '...'
            ],
            [
                'titleAttr' => 'Print',     
                'extend' => 'print',
                'className' => 'custom-btn print',
                'text' => '...'
            ]
        ],


    ]
  
?>