<!DOCTYPE html>

<html lang="pt-BR" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <!-- Importante para habilitar os recursos de Responsividade em conjunto com o CSS -->
        <meta name="keywords" content="HTML5,javascript">
        <title><?= (isset($this->title)) ? $this->title : 'OSSB Solutions Business'; ?></title>
        <meta name="viewport" content="width=1200">
        <meta property="og:title" content="http://myweb.local/ciwebctrl/">
        <meta property="og:image" content="http://myweb.local/ciwebctrl/public/btan/ico/favicon.png">
        <meta property="og:site_name" content="myweb.local/ciwebctrl/">
        <meta property="og:description" content="OSSB Solutions Business">
        <meta content="A OSSB Solutions Business é uma empresa Humilde buscando seu espaço no mercado em Automação e Integração de Sistemas. 
              Somos conhecidos por termos os melhores preços e serviços." name="description"> 

        <!-- Bootstrap 5.1.2 -->
        <!-- Le styles -->
        <link href="<?php echo base_url("public/assets/dist/css/bootstrap.min.css"); ?>" rel="stylesheet">

        <!-- End define Bootstrap -->

        <!-- Le styles -->


        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    </style>


</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
<symbol id="bootstrap" viewBox="0 0 118 94">
    <title>Bootstrap</title>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
</symbol>

<symbol id="speedometer2" viewBox="0 0 16 16">
    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
</symbol>

<symbol id="home" viewBox="0 0 16 16">
    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
</symbol>

<symbol id="speedometer2" viewBox="0 0 16 16">
    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
</symbol>
<symbol id="table" viewBox="0 0 16 16">
    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</symbol>
<symbol id="people-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</symbol>
<symbol id="grid" viewBox="0 0 16 16">
    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
</symbol>
<symbol id="muser-add" viewBox="0 0 128.000000 128.000000">
    <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)"
       fill="#000000" stroke="none">
    <path d="M450 1267 c-51 -16 -126 -95 -141 -148 -37 -132 12 -350 98 -431 59
          -56 169 -75 246 -43 105 44 177 192 177 362 0 181 -90 274 -265 272 -44 -1
          -96 -6 -115 -12z"/>
    <path d="M271 634 c-46 -19 -93 -42 -104 -51 -43 -38 -79 -166 -92 -329 -6
          -68 -5 -83 9 -97 56 -55 461 -118 594 -91 l30 6 -25 55 c-31 67 -34 146 -8
          222 35 105 164 201 271 201 30 0 34 2 25 18 -11 20 -48 40 -137 75 l-60 23
          -44 -33 c-99 -76 -260 -71 -350 11 l-25 23 -84 -33z"/>
    <path d="M890 491 c-51 -17 -89 -42 -124 -82 -46 -55 -59 -96 -54 -179 7 -132
          96 -221 228 -228 84 -5 131 10 182 56 61 55 82 104 82 187 1 106 -48 186 -139
          229 -42 20 -137 30 -175 17z m100 -156 l5 -50 50 -5 c38 -4 51 -9 53 -23 6
          -30 -17 -47 -64 -47 l-44 0 0 -44 c0 -86 -62 -89 -68 -3 l-3 46 -46 3 c-86 6
          -83 68 3 68 l44 0 0 43 c0 48 15 69 45 65 16 -2 21 -13 25 -53z"/>
    </g>  
</symbol>
<symbol id="mcustomer" viewBox="0 0 128.000000 128.000000">
    <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)"
       fill="#000000" stroke="none">
    <path d="M31 1029 l-31 -31 0 -358 0 -358 31 -31 31 -31 578 0 578 0 31 31 31
          31 0 358 0 358 -31 31 -31 31 -578 0 -578 0 -31 -31z m1181 -36 c17 -15 18
          -39 18 -351 0 -298 -2 -337 -17 -354 -15 -17 -46 -18 -571 -18 -503 0 -557 2
          -574 17 -17 15 -18 39 -18 351 0 298 2 337 17 354 15 17 46 18 571 18 503 0
          557 -2 574 -17z"/>
    <path d="M276 911 c-51 -34 -66 -68 -66 -151 0 -75 4 -86 51 -151 20 -27 4
          -45 -55 -59 -72 -17 -89 -36 -94 -108 -7 -93 -8 -93 258 -90 l223 3 19 25 c14
          20 17 35 12 72 -9 61 -31 84 -100 99 -31 7 -58 18 -61 25 -2 7 9 31 26 55 29
          39 31 48 31 126 0 94 -16 130 -70 158 -42 22 -138 19 -174 -4z m147 -43 c37
          -19 46 -41 47 -110 0 -61 -3 -71 -31 -102 -26 -30 -30 -41 -27 -83 l3 -48 75
          -20 c70 -19 75 -22 81 -52 4 -21 2 -36 -6 -43 -8 -7 -83 -9 -206 -8 l-194 3
          -3 32 c-4 38 17 54 93 72 27 7 55 17 62 23 21 17 16 86 -8 106 -34 28 -49 68
          -49 127 0 49 4 60 29 86 23 23 38 29 71 29 23 0 51 -5 63 -12z"/>
    <path d="M684 895 c-3 -8 -3 -19 1 -25 8 -13 301 -14 309 -1 4 5 3 16 0 25 -5
          14 -28 16 -155 16 -122 0 -151 -3 -155 -15z"/>
    <path d="M684 805 c-13 -32 6 -35 247 -35 l239 0 0 25 0 25 -240 0 c-201 0
          -242 -2 -246 -15z"/>
    <path d="M696 694 c-13 -13 -16 -43 -16 -168 0 -105 4 -156 12 -164 17 -17
          449 -17 466 0 17 17 17 319 0 336 -9 9 -74 12 -229 12 -184 0 -220 -2 -233
          -16z m424 -164 l0 -130 -195 0 -195 0 0 130 0 130 195 0 195 0 0 -130z"/>
    <path d="M774 585 c-12 -31 7 -35 156 -35 116 0 149 3 153 14 12 30 -16 36
          -160 36 -116 0 -145 -3 -149 -15z"/>
    <path d="M774 495 c-12 -31 7 -35 156 -35 150 0 165 4 152 38 -7 19 -301 17
          -308 -3z"/>
    </g>    
</symbol>
</svg>

<main>
    <div class="container">
        <header>
            <div class="px-3 py-2 bg-light text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href="<?= site_url('main') ?>" class="nav-link text-secondary text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                                    Principal...
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                                    Painel de Controle...
                                </a>
                            </li>
                            <li>
                                <a class="nav-link text-dark dropdown-toggle" href="<?= site_url('cpny') ?>" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                                    Empresas...
                                </a>
                               <!--  <div class="dropdown">
                                   
                                                                        <ul class="dropdown-menu btn-primary" aria-labelledby="dropdownMenuLink">
                                                                            <li><a class="dropdown-item" href="#">First Item</a></li>
                                                                            <li><a class="dropdown-item" href="#">Second Item</a></li>
                                                                            <li><a class="dropdown-item" href="#">Third Item</a></li>
                                                                        </ul>
                                </div>                     -->
                            </li> 
                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                                    Clientes...
                                </a>
                            </li>                       
                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                                    Colaboradores...
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                                    Produtos...
                                </a>
                            </li>

                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#mcustomer"/></svg>
                                    Logar
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link text-dark">
                                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#muser-add"/></svg>
                                    Criar Conta...
                                </a>
                            </li>                        
                        </ul>
                    </div>
                </div>
            </div>

        </header>
    </div>


