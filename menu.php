<?php

    class Menu{

        function __construct(){}

        function getHead(){
            echo "
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
        
            <script async src='https://code.jquery.com/jquery-3.1.1.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>

            <link defer rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
            <link async href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
        
            <link async rel='stylesheet' type='text/css' href='css/style.css' media='screen' />
            <link async rel='stylesheet' type='text/css' href='css/sidebar.css' media='screen'/>
            <link async rel='stylesheet' type='text/css' href='css/W3.css' media='screen'/>
            <link rel='shortcut icon' href='./img/favicon.png'>
            
            ";
        }

        function getIcon(){
            echo "
            <br>
            <div class='brand_logo_container d-flex justify-content-center'>
                <img src='img/logo.png' class='logotela' alt='Logo' width='100'>
            </div>
            <br>
            ";
        }

        function getNavbar(){
            echo "
            <!-- Navbar -->
            <nav class='navbar navbar-dark bg-success'>
                <div id='mySidebar' class='sidebar shadow'>
                    <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>×</a>
                    <a id='menu_inicio' href='index.php'><img src='img/home.png' style='max-width: 25px;'></img> Início</a>
                    <a id='menu_obras' href='obras.php'><img src='img/worker.png' style='max-width: 25px;'></img> Obras</a>
                    <a id='menu_distribuir' href='alocar_custos.php'><img src='img/money.png' style='max-width: 25px;'></img> Distribuir custos</a>
                    <a id='menu_visualizar' href='filtro_data.php'><img src='img/cost-list.png' style='max-width: 25px;'></img> Visualizar custos</a>
                    
                </div>

                <div id='main'>
                    <button class='openbtn' onclick='openNav()'>☰</button>
                </div>

                <div></div>

                <button name='btn_modal' class='navbar-toggler text-white' data-toggle='modal' data-target='#modal_sair'>
                    <strong class='align-middle'>Sair</strong>
                    <span class='material-icons align-middle'>logout</span>
                </button>

                <!-- Modal -->
                <div class='modal fade' id='modal_sair' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
                    <div class='modal-dialog modal-sm' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4 class='modal-title' id='myModalLabel'>Sair</h4>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Deseja sair do Sistema?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-default small' data-dismiss='modal'>
                                    <strong>Cancelar</strong>
                                    <span class='material-icons align-middle'>close</span>
                                </button>

                                <a class='btn btn-success small' href='logout.php'>
                                    <strong>Concluir</strong>
                                    <span class='material-icons align-middle'>check</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!--Fim Navbar -->  
            

            <script>
                function openNav() {
                    document.getElementById('menu_inicio').style.display = 'block';
                    document.getElementById('menu_obras').style.display = 'block';
                    document.getElementById('menu_distribuir').style.display = 'block';
                    document.getElementById('mySidebar').style.width = '300px';
                    document.getElementById('main').style.marginLeft = '300px';
                    document.getElementById('main').style.display = 'none';
                }

                function closeNav() {
                    document.getElementById('menu_inicio').style.display = 'none';
                    document.getElementById('menu_obras').style.display = 'none';
                    document.getElementById('menu_distribuir').style.display = 'none';
                    document.getElementById('mySidebar').style.width = '0';
                    document.getElementById('main').style.marginLeft = '0';
                    document.getElementById('main').style.display = 'inline';
                }
            </script>
            ";
        }

        function getFooter(){
            echo "
            <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
            

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js' integrity='sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj' crossorigin='anonymous'></script>
    
            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js' integrity='sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp' crossorigin='anonymous'></script>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js' integrity='sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/' crossorigin='anonymous'></script>
            ";
        }
    }
