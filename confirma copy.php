<?php

session_start();

include_once('db_class.php');

class Confirma extends Db
{
    function __construct()
    {
        $this->setEntrada();
    }

    function setEntrada()
    {
        if (isset($_POST['btn_entrar'])) {
            $this->getEntrar();
        
        } elseif (isset($_POST['btn_editar_obras'])) {
            $contador = 0;
            $obra_geral = $_POST['obra_geral'][$contador];
            $id_obra_geral = $_POST['id_obra_geral'][$contador];
            header("Location:editar_obra.php?obra_geral=" . urlencode($obra_geral) . "&id_obra_geral=" . urlencode($id_obra_geral));
        
        } elseif (isset($_POST['btn_editar_obra'])) {
            $this->editarObra();
        
        } elseif (isset($_POST['btn_apagar_obras'])) {
            $this->apagarObra();
        
        } elseif (isset($_POST['btn_editar_sub_obras'])) {
            $contador = 0;
            $id_sub_obra = $_POST['id_sub_obra'][$contador];
            $sub_obra = $_POST['sub_obra'][$contador];
            $fk_obra_geral = $_POST['fk_obra_geral'][$contador];
            
            header("Location:editar_sub_obra.php?sub_obra=" . urlencode($sub_obra) . "&id_sub_obra=" . urlencode($id_sub_obra) . "&fk_obra_geral=" . urlencode($fk_obra_geral));
        
        } elseif (isset($_POST['btn_editar_sub_obra'])) {
            $this->editarSubObra();
        
        } elseif (isset($_POST['btn_apagar_sub_obras'])) {
            $this->apagarSubObra();
        
        } elseif (isset($_POST['btn_editar_frotas_veiculos'])) {
            $contador = 0;
            $id_frota_veiculo = $_POST['id_frota_veiculo'][$contador];
            $frota_veiculo = $_POST['frota_veiculo'][$contador];
            $marca = $_POST['marca'][$contador];
            
            header("Location:editar_frota_veiculo.php?frota_veiculo=" . urlencode($frota_veiculo) . "&id_frota_veiculo=" . urlencode($id_frota_veiculo). "&marca=" . urlencode($marca));
        
        } elseif (isset($_POST['btn_editar_frota_veiculo'])) {
            $this->editarFrotaVeiculo();
        
        } elseif (isset($_POST['btn_editar_veiculos'])) {
            $contador = 0;
            $veiculo = $_POST['placa'][$contador];
            $id_veiculo = $_POST['id_veiculo'][$contador];
            header("Location:editar_veiculo.php?placa=" . urlencode($veiculo) . "&id_veiculo=" . urlencode($id_veiculo));
        
        } elseif (isset($_POST['btn_editar_veiculo'])) {
            $this->editarVeiculo();
        
        } elseif (isset($_POST['btn_apagar_veiculos'])) {
            $this->apagarVeiculos();
        
        } elseif (isset($_POST['btn_apagar_frotas_veiculos'])) {
            $this->apagarFrotasVeiculos();
        
        } elseif (isset($_POST['btn_editar_frotas'])) {
            $contador = 0;
            $frota = $_POST['numero_frota'][$contador];
            $id_frota = $_POST['id_frota'][$contador];
            header("Location:editar_frota.php?numero_frota=" . urlencode($frota) . "&id_frota=" . urlencode($id_frota));
        
        } elseif (isset($_POST['btn_editar_frota'])) {
            $this->editarFrota();
        
        } elseif (isset($_POST['btn_apagar_frotas'])) {
            $this->apagarFrota();
        
        } elseif (isset($_POST['btn_editar_itens_servico'])) {
            $contador = 0;
            $id_servico = $_POST['id_servico'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $descricao_servico = $_POST['descricao_servico'][$contador];
            $tipo_manutencao = $_POST['tipo_manutencao'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $frota_veiculo1 = $_POST['frota_veiculo'][$contador];
            $marca = $_POST['marca_veiculo'][$contador];
            $sub_obra1 = $_POST['sub_obra'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];


            header("Location:editar_servico.php?id_servico=" . urlencode($id_servico) . "&fornecedor=" . urlencode($fornecedor) ."&data_emissao=" . urlencode($data_emissao) ."&numero=" . urlencode($numero) . "&qtd=" . urlencode($qtd) ."&tipo_manutencao=" . urlencode($tipo_manutencao) ."&descricao_servico=" . urlencode($descricao_servico) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&frota_veiculo=" . urlencode($frota_veiculo1) . "&marca_veiculo=" . urlencode($marca) . "&obra_geral=" . urlencode($obra_geral1) . "&sub_obra=" . urlencode($sub_obra1) .  "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));
        
        } elseif (isset($_POST['btn_editar_item_servico'])) {
            $this->editarServico();
        
        } elseif (isset($_POST['btn_editar_item_servico2'])) {
            $this->editarServico2();
        
        }  elseif (isset($_POST['btn_editar_item_recibo2'])) {
            $this->editarRecibo2();
        
        } elseif (isset($_POST['btn_editar_item_recibo'])) {
            $this->editarRecibo();
        
        } elseif (isset($_POST['btn_editar_itens_servico2'])) {
            $contador = 0;
            $id_pagamento = $_POST['id_pagamento'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $descricao = $_POST['descricao'][$contador];
            $classificacao = $_POST['classificacao'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:editar_servico2.php?id_pagamento=" . urlencode($id_pagamento) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&classificacao=" . urlencode($classificacao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_editar_itens_recibo'])) {
            $contador = 0;
            $id_recibo = $_POST['id_recibo'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $descricao = $_POST['descricao'][$contador];
            $tipo_manutencao = $_POST['tipo_manutencao'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $frota_veiculo = $_POST['frota_veiculo'][$contador];
            $marca_veiculo = $_POST['marca_veiculo'][$contador];
            $sub_obra = $_POST['sub_obra'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:editar_recibo.php?id_recibo=" . urlencode($id_recibo) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&tipo_manutencao=" . urlencode($tipo_manutencao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&marca_veiculo=" . urlencode($marca_veiculo) . "&frota_veiculo=" . urlencode($frota_veiculo) . "&sub_obra=" . urlencode($sub_obra) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_editar_itens_recibo2'])) {
            $contador = 0;
            $id_pagamento = $_POST['id_pagamento'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $descricao = $_POST['descricao'][$contador];
            $classificacao = $_POST['classificacao'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:editar_recibo2.php?id_pagamento=" . urlencode($id_pagamento) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&classificacao=" . urlencode($classificacao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_info_servicos'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];
            

            header("Location:info_itens_servico.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_info_servicos2'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];  

            header("Location:info_itens_servico2.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_apagar_itens_servico'])) {
            $this->apagarServico();
        
        } elseif (isset($_POST['btn_apagar_itens_servico2'])) {
            $this->apagarServico2();
        
        } elseif (isset($_POST['btn_apagar_itens_recibo'])) {
            $this->apagarRecibo();
        
        } elseif (isset($_POST['btn_apagar_itens_recibo2'])) {
            $this->apagarRecibo2();
        
        } elseif (isset($_POST['btn_editar_itens_compra'])) {
            $contador = 0;
            $id_compra = $_POST['id_compra'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $nome_produto = $_POST['nome_produto'][$contador];
            $tipo_produto = $_POST['tipo_produto'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $frota_veiculo1 = $_POST['frota_veiculo'][$contador];
            $edit_marca2 = $_POST['marca_veiculo'][$contador];
            $sub_obra1 = $_POST['sub_obra'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:editar_compra.php?id_compra=" . urlencode($id_compra) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&nome_produto=" . urlencode($nome_produto) . "&tipo_produto=" . urlencode($tipo_produto) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&frota_veiculo=" . urlencode($frota_veiculo1) . "&marca_veiculo=" . urlencode($edit_marca2) . "&obra_geral=" . urlencode($obra_geral1) . "&sub_obra=" . urlencode($sub_obra1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_editar_itens_compra2'])) {
            $contador = 0;
            $id_pagamento = $_POST['id_pagamento'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $descricao = $_POST['descricao'][$contador];
            $classificacao = $_POST['classificacao'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $empresa = $_POST['empresa'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:editar_compra2.php?id_pagamento=" . urlencode($id_pagamento) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&classificacao=" . urlencode($classificacao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_editar_item_compra'])) {
            $this->editarCompra();
        
        } elseif (isset($_POST['btn_editar_item_compra2'])) {
            $this->editarCompra2();
        
        } elseif (isset($_POST['btn_info_compras'])) {
            $contador = 0;
            $id_compra = $_POST['id_compra'][$contador];
            $data_emissao = $_POST['data_emissao'][$contador];
            $fornecedor = $_POST['fornecedor'][$contador];
            $numero = $_POST['numero'][$contador];
            $qtd = $_POST['qtd'][$contador];
            $produto = $_POST['nome_produto'][$contador];
            $valor_unitario = $_POST['valor_unitario'][$contador];
            $valor_desconto = $_POST['valor_desconto'][$contador];
            $valor_total = $_POST['valor_total'][$contador];
            $forma_pagamento = $_POST['forma_pagamento'][$contador];
            $frota_veiculo1 = $_POST['frota_veiculo'][$contador];
            $obra_geral1 = $_POST['obra_geral'][$contador];
            $sub_obra1 = $_POST['sub_obra'][$contador];
            $observacao = $_POST['observacao'][$contador];

            header("Location:info_compra.php?id_compra=" . urlencode($id_compra) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&nome_produto=" . urlencode($produto) . "&numero=" . urlencode($numero) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_desconto=" . urlencode($valor_desconto) . "&valor_total=" . urlencode($valor_total) . "&forma_pagamento=" . urlencode($forma_pagamento) . "&frota_veiculo=" . urlencode($frota_veiculo1) . "&obra_geral=" . urlencode($obra_geral1) . "&sub_obra=" . urlencode($sub_obra1) . "&observacao=" . urlencode($observacao)); 
        
        } elseif (isset($_POST['btn_info_comprass'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];

            header("Location:info_itens_compra.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_info_comprass2'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];
            
            header("Location:info_itens_compra2.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_info_recibos2'])) {
            $contador = 0;
            $id = $_POST['id_pagamento'][$contador];
            
            header("Location:info_itens_recibo2.php?id_pagamento=" . urlencode($id)); 
        
        } elseif (isset($_POST['btn_info_recibos'])) {
            $contador = 0;
            $id2 = $_POST['id_recibo'][$contador];
            
            header("Location:info_itens_recibo.php?id_recibo=" . urlencode($id2)); 
        
        } elseif (isset($_POST['btn_apagar_itens_compra'])) {
            $this->apagarCompra();
        
        } elseif (isset($_POST['btn_apagar_itens_compra2'])) {
            $this->apagarCompra2();
        
        } elseif (isset($_POST['btn_resultado_periodo'])) {
            $radio = $_POST['radio_visualizar_custos'];

            $data_inicio = $_POST['dataInicio'];
            $data_fim = $_POST['dataFim'];

            if($radio == "veiculos"){
                header("Location:listar_custos_data.php?dataInicio=" . urlencode($data_inicio) . "&dataFim=" . urlencode($data_fim));
            } else {
                header("Location:listar_custos_data2.php?dataInicio=" . urlencode($data_inicio) . "&dataFim=" . urlencode($data_fim));
            }
        
        } else {
            header("Location:../index.php");
        }
    }

    function getEntrar()

    {   /* validando formulário de entrada */
        /* verifica se existe os campos */
        if (isset($_POST['usuario']) && isset($_POST['senha'])) {
            $usuario = $_POST['usuario'];
            $senha = MD5($_POST['senha']);
        }
        /* buscando a lista de usuarios cadastrados no banco */
        $query_select = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

        $verifica = mysqli_query($this->conecta_mysql(), $query_select)
            or die("erro ao selecionar");

        if (mysqli_num_rows($verifica) <= 0) {
            echo    "<script language='javascript' type='text/javascript'>
                    alert('Usuário e/ou senha incorreto!');
                    window.location.href='login.php';
                    </script>";
            die();
        } else {
            $_SESSION['ativo'] = true;
            $_SESSION['usuario'] = $usuario;

            $userAtivo = "UPDATE usuarios 
                            SET ativo = 1
                            WHERE  usuario =  '$usuario'";
            mysqli_query($this->conecta_mysql(), $userAtivo);

            $select_centro = "SELECT empresa 
                                FROM usuarios 
                                WHERE usuario = '$usuario'";

            $query_centro = mysqli_query($this->conecta_mysql(), $select_centro);
            $row_centro = mysqli_fetch_assoc($query_centro);

            $_SESSION['empresa'] = $row_centro['empresa'];

            /* Direcionando para a pagina inicial */
            header("Location:../index.php");
        }
    }

    function editarObra()
    {

        $edit_obra_geral = $_POST['txt_editar_obra'];
        $id_obra_geral = $_POST['txt_id_obra_geral'];

        $update_obra = "UPDATE obras_gerais 
                        SET obra_geral = '$edit_obra_geral'
                        WHERE id_obra_geral = $id_obra_geral ";

        $update = mysqli_query($this->conecta_mysql(), $update_obra);

        if ($update) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_obras_gerais.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_obras_gerais.php';</script>";
        }
    }

    function apagarObra()
    {

        $id_obra_geral2 = $_POST['id_obra_geral'][0];

        $delete_obra_geral = "DELETE FROM obras_gerais WHERE id_obra_geral = '$id_obra_geral2'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_obra_geral);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_obras_gerais.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_obras_gerais.php';</script>";
        }
    }

    function editarSubObra()
    {

        $edit_sub_obra = $_POST['txt_editar_sub_obra'];
        $id_sub_obra = $_POST['txt_id_sub_obra'];
        $fk_obra_geral = $_POST['fk_obg_sub'];

        $update_sub_obra = "UPDATE sub_obras 
                        SET sub_obra = '$edit_sub_obra',
                            fk_obra_geral = $fk_obra_geral
                        WHERE id_sub_obra = $id_sub_obra ";

        $update2 = mysqli_query($this->conecta_mysql(), $update_sub_obra);

        if ($update2) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_sub_obras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_sub_obras.php';</script>";
        }
    }

    function apagarSubObra()
    {

        $id_sub_obra2 = $_POST['id_sub_obra'][0];

        $delete_sub_obra = "DELETE FROM sub_obras WHERE id_sub_obra = '$id_sub_obra2'";
        $query_delete2 = mysqli_query($this->conecta_mysql(), $delete_sub_obra);

        if ($query_delete2) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_sub_obras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_sub_obras.php';</script>";
        }
    }

    function editarFrotaVeiculo()
    {

        $edit_frota_veiculo = $_POST['txt_editar_frota_veiculo'];
        $edit_marca = $_POST['txt_editar_marca'];
        $id_frota_veiculo = $_POST['txt_id_frota_veiculo'];

        $update_frota_veiculo = "UPDATE frotas_veiculos
                        SET frota_veiculo = '$edit_frota_veiculo',
                            marca = '$edit_marca'
                        WHERE id_frota_veiculo = $id_frota_veiculo ";

        $update3 = mysqli_query($this->conecta_mysql(), $update_frota_veiculo);

        if ($update3) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_frotas_veiculos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_frotas_veiculos.php';</script>";
        }
    }

    function apagarFrotasVeiculos()
    {

        $id_frota_veiculo2 = $_POST['id_frota_veiculo'][0];

        $delete_frota_veiculo = "DELETE FROM frotas_veiculos WHERE id_frota_veiculo = '$id_frota_veiculo2'";
        $query_delete3 = mysqli_query($this->conecta_mysql(), $delete_frota_veiculo);

        if ($query_delete3) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_frotas_veiculos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_frotas_veiculos.php';</script>";
        }
    }

    function editarVeiculo(){
        $edit_placa = $_POST['txt_editar_veiculo'];
        $id_veiculo = $_POST['txt_id_veiculo'];

        $update_veiculo = "UPDATE veiculos
                        SET placa = '$edit_placa'
                        WHERE id_veiculo = $id_veiculo ";

        $update = mysqli_query($this->conecta_mysql(), $update_veiculo);

        if ($update) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_veiculos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_veiculos.php';</script>";
        }
    }

    function apagarVeiculos()
    {
        $id_veiculo = $_POST['id_veiculo'][0];

        $delete_veiculo = "DELETE FROM veiculos WHERE id_veiculo = '$id_veiculo'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_veiculo);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_veiculos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_veiculos.php';</script>";
        }
    }




    function editarServico(){
        $id_servico = $_POST['txt_id_servico'];
        $descricao_servico1 = $_POST['txt_editar_descricao1'];
        $tipo_manutencao1 = $_POST['txt_editar_tipo_manutencao1'];
        $qtd = $_POST['txt_editar_qtd'];
        $unitario = $_POST['txt_valor_unitario'];
        $total = $_POST['txt_valor_total'];
        $frota_veiculo4 = $_POST['txt_editar_frota_veiculo1'];
        $edit_marca_veic2 = $_POST['marca_veiculo_servico2'];
        $sub_obra4 = $_POST['txt_editar_sub_obra1'];
        $obra_geral4 = $_POST['txt_editar_obra_geral1'];
        $empresa = $_POST['txt_editar_empresa'];
        $observacao1 = $_POST['txt_editar_observacao1'];

        $update_servico = "UPDATE notas_servicos
                        SET descricao_servico = '$descricao_servico1',
                            tipo_manutencao = '$tipo_manutencao1',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $total,
                            frota_veiculo = '$frota_veiculo4',
                            marca_veiculo = '$edit_marca_veic2',
                            sub_obra = '$sub_obra4',
                            obra_geral = '$obra_geral4',
                            empresa = '$empresa',
                            observacao = '$observacao1'               
                        WHERE id_servico = $id_servico ";
    

        $update5 = mysqli_query($this->conecta_mysql(), $update_servico);

        if($update5){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_servicos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_servicos.php';</script>";
        }
    } 

    function editarServico2(){
        $id_pagamento = $_POST['txt_id_pagamento'];
        $produto = $_POST['txt_editar_produto2'];
        $classificacao = $_POST['classificacao_edit'];
        $qtd = $_POST['txt_editar_qtd2'];
        $unitario = $_POST['txt_valor_unitario2'];
        $valor_total = $_POST['txt_valor_total2'];
        $obra_geral3 = $_POST['txt_editar_obra_geral2'];
        $empresa = $_POST['txt_editar_empresa2'];
        $observacao = $_POST['txt_editar_observacao2'];

        $update_compra = "UPDATE pgtos_obras
                        SET descricao = '$produto',
                            classificacao = '$classificacao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            obra_geral = '$obra_geral3',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_pagamento = $id_pagamento ";


        $update = mysqli_query($this->conecta_mysql(), $update_compra);

        if($update){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_servicos2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_servicos2.php';</script>";
        }
    }

    function editarRecibo(){
        $id_recibo = $_POST['recibo_id_recibo'];
        $fornecedor = $_POST['recibo_editar_fornecedor'];
        $data = $_POST['recibo_data_editar'];
        $numero = $_POST['recibo_editar_numero'];
        $descricao = $_POST['recibo_editar_descricao'];
        $tipo_manutencao = $_POST['recibo_tipo_manutencao'];
        $qtd = $_POST['recibo_editar_qtd'];
        $unitario = $_POST['recibo_valor_unitario2'];
        $valor_total = $_POST['recibo_valor_total2'];
        $frota_veiculo = $_POST['frota_veiculo'];
        $marca = $_POST['marca_veiculo'];
        $sub_obra = $_POST['sub_obra'];
        $obra_geral3 = $_POST['obra_geral'];
        $empresa = $_POST['recibo_editar_empresa2'];
        $observacao = $_POST['recibo_editar_observacao2'];

        $update_recibo = "UPDATE notas_recibos
                        SET fornecedor = '$fornecedor',
                            data_emissao = '$data',
                            numero = $numero,
                            descricao = '$descricao',
                            tipo_manutencao = '$tipo_manutencao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            frota_veiculo = '$frota_veiculo',
                            marca_veiculo = '$marca',
                            sub_obra = '$sub_obra',
                            obra_geral = '$obra_geral3',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_recibo = $id_recibo ";


        $update_recibo2 = mysqli_query($this->conecta_mysql(), $update_recibo);

        if($update_recibo2){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_recibos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_recibos.php';</script>";
        }
    }

    function editarRecibo2(){
        $id_pagamento = $_POST['recibo_id_pagamento'];
        $fornecedor = $_POST['recibo_editar_fornecedor2'];
        $data = $_POST['recibo_data_editar2'];
        $numero = $_POST['recibo_editar_numero2'];
        $descricao = $_POST['recibo_editar_produto2'];
        $classificacao = $_POST['classificacao_recibo'];
        $qtd = $_POST['recibo_editar_qtd2'];
        $unitario = $_POST['recibo_valor_unitario2'];
        $valor_total = $_POST['recibo_valor_total2'];
        $obra_geral3 = $_POST['recibo_editar_obra_geral2'];
        $empresa = $_POST['recibo_editar_empresa2'];
        $observacao = $_POST['recibo_editar_observacao2'];

        $update_recibo = "UPDATE pgtos_obras
                        SET fornecedor = '$fornecedor',
                            data_emissao = '$data',
                            numero = $numero,
                            descricao = '$descricao',
                            classificacao = '$classificacao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            obra_geral = '$obra_geral3',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_pagamento = $id_pagamento ";


        $update_recibo2 = mysqli_query($this->conecta_mysql(), $update_recibo);

        if($update_recibo2){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_recibos2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_recibos2.php';</script>";
        }
    }

    function apagarServico(){
        $id_servico = $_POST['id_servico'][0];

        $delete_servico = "DELETE FROM notas_servicos WHERE id_servico = '$id_servico'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_servico);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_servicos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_servicos.php';</script>";
        }
    }

    function apagarServico2(){
        $id_pagamento2 = $_POST['id_pagamento'][0];

        $delete_servico = "DELETE FROM pgtos_obras WHERE id_pagamento = '$id_pagamento2'";

        $query_delete = mysqli_query($this->conecta_mysql(), $delete_servico);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                    window.location.href='../listar_servicos2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_servicos2.php';</script>";
        }
    }

    function apagarRecibo(){
        $id_recibo2 = $_POST['id_recibo'][0];

        $delete_recibo4 = "DELETE FROM notas_recibos WHERE id_recibo = '$id_recibo2'";

        $query_delete = mysqli_query($this->conecta_mysql(), $delete_recibo4);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                    window.location.href='../listar_recibos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_recibos.php';</script>";
        }
    }

    function apagarRecibo2(){
        $id_pagamento2 = $_POST['id_pagamento'][0];

        $delete_recibo3 = "DELETE FROM pgtos_obras WHERE id_pagamento = '$id_pagamento2'";

        $query_delete = mysqli_query($this->conecta_mysql(), $delete_recibo3);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                    window.location.href='../listar_recibos2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_recibos2.php';</script>";
        }
    }

    function editarCompra(){
        $id_compra = $_POST['txt_id_compra'];
        $produto = $_POST['txt_editar_produto2'];
        $tipo_produto = $_POST['tipo_produto_edit'];
        $qtd = $_POST['txt_editar_qtd2'];
        $unitario = $_POST['txt_valor_unitario2'];
        $valor_total = $_POST['txt_valor_total2'];
        $frota_veiculo3 = $_POST['txt_editar_frota_veiculo2'];
        $edit_marca3 = $_POST['marca_veiculo2'];  
        $sub_obra3 = $_POST['txt_editar_sub_obra2'];
        $obra_geral3 = $_POST['txt_editar_obra_geral2'];
        $empresa = $_POST['txt_editar_empresa2'];
        $observacao = $_POST['txt_editar_observacao2'];

        $update_compra = "UPDATE notas_compras
                        SET nome_produto = '$produto',
                            tipo_produto = '$tipo_produto',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            frota_veiculo = '$frota_veiculo3',
                            marca_veiculo = '$edit_marca3',
                            obra_geral = '$obra_geral3',
                            sub_obra = '$sub_obra3',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_compra = $id_compra ";

        $update = mysqli_query($this->conecta_mysql(), $update_compra);

        if($update){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_compras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_compras.php';</script>";
        }

    }

    function editarCompra2(){
        $id_pagamento = $_POST['txt_id_pagamento'];
        $produto = $_POST['txt_editar_produto2'];
        $classificacao = $_POST['classificacao_edit'];
        $qtd = $_POST['txt_editar_qtd2'];
        $unitario = $_POST['txt_valor_unitario2'];
        $valor_total = $_POST['txt_valor_total2'];
        $obra_geral3 = $_POST['txt_editar_obra_geral2'];
        $empresa = $_POST['txt_editar_empresa2'];
        $observacao = $_POST['txt_editar_observacao2'];

        $update_compra = "UPDATE pgtos_obras
                        SET descricao = '$produto',
                            classificacao = '$classificacao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            obra_geral = '$obra_geral3',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_pagamento = $id_pagamento ";


        $update = mysqli_query($this->conecta_mysql(), $update_compra);

        if($update){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_compras2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_compras2.php';</script>";
        }

    }

    function apagarCompra(){
        $id_compra = $_POST['id_compra'][0];

        $delete_compra = "DELETE FROM notas_compras WHERE id_compra = '$id_compra'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_compra);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_compras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_compras.php';</script>";
        }
    }

    function apagarCompra2(){
        $id_pagamento = $_POST['id_pagamento'][0];

        $delete_compra = "DELETE FROM pgtos_obras WHERE id_pagamento = '$id_pagamento'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_compra);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_compras2.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_compras2.php';</script>";
        }
    }

    function editarFrota(){
        $edit_frota = $_POST['txt_editar_frota'];
        $id_frota = $_POST['txt_id_frota'];

        $update_frota = "UPDATE frotas
                        SET numero_frota = '$edit_frota'
                        WHERE id_frota = $id_frota ";

        $update = mysqli_query($this->conecta_mysql(), $update_frota);

        if ($update) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='../listar_frotas.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='../listar_frotas.php';</script>";
        }
    }

    function apagarFrota(){
        $id_frota = $_POST['id_frota'][0];

        $delete_frota = "DELETE FROM frotas WHERE id_frota = '$id_frota'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_frota);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='../listar_frotas.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='../listar_frotas.php';</script>";
        }
    }
}
$confirma = new Confirma();
