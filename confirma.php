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
        
        } elseif (isset($_POST['btn_compra_salva'])) {
            $this->AdcCompra();
        
        } elseif (isset($_POST['btn_servico_salva'])) {
            $this->AdcServico();
        
        } elseif (isset($_POST['btn_editar_obras'])) {
            $contador = 0;
            $obra_geral = $_POST['obra_geral'][$contador];
            $id_obra_geral = $_POST['id_obra_geral'][$contador];
            header("Location:editar_obra.php?obra_geral=" . urlencode($obra_geral) . "&id_obra_geral=" . urlencode($id_obra_geral));
        
        } elseif (isset($_POST['btn_editar_obra'])) {
            $this->editarObra();
        
        } elseif (isset($_POST['btn_editar_sub_obras'])) {
            $contador = 0;
            $id_sub_obra = $_POST['id_sub_obra'][$contador];
            $sub_obra = $_POST['sub_obra'][$contador];
            $fk_obra_geral = $_POST['fk_obra_geral'][$contador];
            
            header("Location:editar_sub_obra.php?sub_obra=" . urlencode($sub_obra) . "&id_sub_obra=" . urlencode($id_sub_obra) . "&fk_obra_geral=" . urlencode($fk_obra_geral));
        
        } elseif (isset($_POST['btn_editar_sub_obra'])) {
            $this->editarSubObra();
        
        } elseif (isset($_POST['btn_info_compras'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];
            
            header("Location:info_itens_compra.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_editar_itens_compra'])) {
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

            header("Location:editar_compra.php?id_pagamento=" . urlencode($id_pagamento) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&classificacao=" . urlencode($classificacao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_editar_item_compra'])) {
            $this->editarCompra();
        
        } elseif (isset($_POST['btn_editar_itens_servico'])) {
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

            header("Location:editar_servico.php?id_pagamento=" . urlencode($id_pagamento) . "&data_emissao=" . urlencode($data_emissao) . "&fornecedor=" . urlencode($fornecedor) . "&numero=" . urlencode($numero) . "&descricao=" . urlencode($descricao) . "&classificacao=" . urlencode($classificacao) . "&qtd=" . urlencode($qtd) . "&valor_unitario=" . urlencode($valor_unitario) . "&valor_total=" . urlencode($valor_total) . "&obra_geral=" . urlencode($obra_geral1) . "&empresa=" . urlencode($empresa) . "&observacao=" . urlencode($observacao));   
        
        } elseif (isset($_POST['btn_info_servicos'])) {
            $contador = 0;
            $numero = $_POST['numero'][$contador];
            
            header("Location:info_itens_servico.php?numero=" . urlencode($numero)); 
        
        } elseif (isset($_POST['btn_editar_item_servico'])) {
            $this->editarServico();
        
        } elseif (isset($_POST['btn_apagar_itens_compra'])) {
            $this->apagarCompra();
        
        } elseif (isset($_POST['btn_apagar_itens_servico'])) {
            $this->apagarServico();
        
        }elseif (isset($_POST['btn_resultado_periodo'])) {

            $data_inicio = $_POST['dataInicio'];
            $data_fim = $_POST['dataFim'];

            header("Location:listar_custos_data.php?dataInicio=" . urlencode($data_inicio) . "&dataFim=" . urlencode($data_fim));
        }
    }

    function getEntrar(){ 
        
        /* validando formulário de entrada */
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
            $_SESSION['ativo'] = 1;
            $_SESSION['usuario'] = $usuario;

            $userAtivo = "UPDATE usuarios SET ativo = 1 WHERE  usuario =  '$usuario'";
            mysqli_query($this->conecta_mysql(), $userAtivo);

            /* Direcionando para a pagina inicial */
            header("Location: index.php");
        }
    }

    function AdcCompra(){

        /* Recebendo dados dos inputs */
        $tipo_documento = isset($_POST['tipo_documento']) ? $_POST['tipo_documento'] : null;
        $tipo_movimento = isset($_POST['tipo_movimento']) ? $_POST['tipo_movimento'] : null;
        $emitente_nome = isset($_POST['emitente_nome']) ? $_POST['emitente_nome'] : null;
        $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
        $data_emissao = isset($_POST['data_emissao']) ? $_POST['data_emissao'] : null;
        $nome_produto = isset($_POST['nome_produto']) ? $_POST['nome_produto'] : null;
        $classificacao = isset($_POST['classificacao']) ? $_POST['classificacao'] : null;
        $qtd = isset($_POST['qtd']) ? $_POST['qtd'] : null;
        $valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : null;
        $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : null;
        $obra_geral = isset($_POST['obra_geral']) ? $_POST['obra_geral'] : null;
        $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
        $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;

        /* Se for despesa - tipo_movimento = 1 Senao = 0 */
        $tipo_movimento === 'Despesa' ? $tipo_movimento = 1 : 0;

        /* Convertendo valores para o tipo correto */
        $tipo_movimento = (int)$tipo_movimento;
        $numero = (int)$numero;
        $qtd = (int)$qtd;
        $valor_unitario = (float)$valor_unitario;
        $valor_total = (float)$valor_total;

        /* Consulta SQL */
        $sql = " INSERT INTO pgtos_obras
                (tipo_documento,
                tipo_movimento,
                fornecedor,
                numero,
                data_emissao, 
                descricao,
                classificacao,
                qtd, 
                valor_unitario, 
                valor_total, 
                obra_geral, 
                empresa,
                observacao) 
                VALUES ('$tipo_documento',
                $tipo_movimento,
                '$emitente_nome',
                $numero,
                '$data_emissao', 
                '$nome_produto',
                '$classificacao',
                $qtd, 
                $valor_unitario, 
                $valor_total,  
                '$obra_geral', 
                '$empresa',
                '$observacao') ";

        /* Se os valores não forem vazios */
        if (!empty($tipo_documento) && !empty($data_emissao) && !empty($emitente_nome) && !empty($numero) && !empty($nome_produto) && !empty($classificacao) && !empty($qtd) && !empty($valor_unitario) && !empty($valor_total) && !empty($obra_geral) && !empty($empresa)) {
            
            /* Insere no banco de dados */
            $insert = mysqli_query($this->conecta_mysql(), $sql);
            
            if ($insert) {
                echo "<script type='text/javascript'>alert('Registro adicionado com sucesso!')
                window.location.href='adicionar_compra2.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Erro ao adicionar!')
                window.location.href='adicionar_compra2.php';</script>";
            }
        }
    }

    function AdcServico(){

        /* Recebendo dados dos inputs */
        $tipo_documento = isset($_POST['tipo_documento']) ? $_POST['tipo_documento'] : null;
        $tipo_movimento = isset($_POST['tipo_movimento']) ? $_POST['tipo_movimento'] : null;
        $emitente_nome = isset($_POST['emitente_nome']) ? $_POST['emitente_nome'] : null;
        $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
        $data_emissao = isset($_POST['data_emissao']) ? $_POST['data_emissao'] : null;
        $descricao = isset($_POST['descricao_servico']) ? $_POST['descricao_servico'] : null;
        $classificacao = isset($_POST['classificacao']) ? $_POST['classificacao'] : null;
        $qtd = isset($_POST['qtd']) ? $_POST['qtd'] : null;
        $valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : null;
        $valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : null;
        $obra_geral = isset($_POST['obra_geral']) ? $_POST['obra_geral'] : null;
        $empresa = isset($_POST['empresa']) ? $_POST['empresa'] : null;
        $observacao = isset($_POST['observacao']) ? $_POST['observacao'] : null;

        /* Se for despesa - tipo_movimento = 1 Senao = 0 */
        $tipo_movimento === 'Despesa' ? $tipo_movimento = 1 : 0;

        /* Convertendo valores para o tipo correto */
        $tipo_movimento = (int)$tipo_movimento;
        $numero = (int)$numero;
        $qtd = (int)$qtd;
        $valor_unitario = (float)$valor_unitario;
        $valor_total = (float)$valor_total;

        /* Consulta SQL */
        $sql = " INSERT INTO pgtos_obras
                (tipo_documento,
                tipo_movimento,
                fornecedor,
                numero,
                data_emissao, 
                descricao,
                classificacao,
                qtd, 
                valor_unitario, 
                valor_total, 
                obra_geral, 
                empresa,
                observacao) 
                VALUES ('$tipo_documento',
                $tipo_movimento,
                '$emitente_nome',
                $numero,
                '$data_emissao', 
                '$descricao',
                '$classificacao',
                $qtd, 
                $valor_unitario, 
                $valor_total,  
                '$obra_geral', 
                '$empresa',
                '$observacao') ";

        /* Se os valores não forem vazios */
        if (!empty($tipo_documento) && !empty($data_emissao) && !empty($emitente_nome) && !empty($numero) && !empty($descricao) && !empty($classificacao) && !empty($qtd) && !empty($valor_unitario) && !empty($valor_total) && !empty($obra_geral) && !empty($empresa)) {
            
            /* Insere no banco de dados */
            $insert = mysqli_query($this->conecta_mysql(), $sql);

            if ($insert) {
                echo "<script type='text/javascript'>alert('Registro adicionado com sucesso!')
                    window.location.href='adicionar_servico2.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Erro ao adicionar!')
                    window.location.href='adicionar_servico2.php';</script>";
            }
        }
    }

    function editarObra(){

        $edit_obra_geral = $_POST['txt_editar_obra'];
        $id_obra_geral = $_POST['txt_id_obra_geral'];

        $update_obra = "UPDATE obras_gerais SET obra_geral = '$edit_obra_geral'
                        WHERE id_obra_geral = $id_obra_geral ";

        $update = mysqli_query($this->conecta_mysql(), $update_obra);

        if ($update) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='listar_obras_gerais.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='listar_obras_gerais.php';</script>";
        }
    }

    function editarSubObra(){

        $edit_sub_obra = $_POST['txt_editar_sub_obra'];
        $id_sub_obra = $_POST['txt_id_sub_obra'];
        $fk_obra_geral = $_POST['fk_obg_sub'];
        
        $update_sub_obra = "UPDATE sub_obras SET sub_obra = '$edit_sub_obra', fk_obra_geral = $fk_obra_geral
                            WHERE id_sub_obra = $id_sub_obra ";

        $update = mysqli_query($this->conecta_mysql(), $update_sub_obra);

        if ($update) {
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='listar_sub_obras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='listar_sub_obras.php';</script>";
        }
    }

    function editarCompra(){

        $id_pagamento = $_POST['txt_id_pagamento'];
        $fornecedor = $_POST['emitente_nome'];
        $numero = $_POST['numero'];
        $data = $_POST['data_emissao'];
        $produto = $_POST['produto'];
        $classificacao = $_POST['classificacao'];
        $qtd = $_POST['qtd'];
        $unitario = $_POST['valor_unitario'];
        $valor_total = $_POST['valor_total'];
        $obra_geral = $_POST['obra_geral'];
        $empresa = $_POST['empresa'];
        $observacao = $_POST['observacao'];

        $update_compra = "UPDATE pgtos_obras
                        SET fornecedor = '$fornecedor',
                            numero = $numero,
                            data_emissao = '$data',
                            descricao = '$produto',
                            classificacao = '$classificacao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            obra_geral = '$obra_geral',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_pagamento = $id_pagamento ";

        $update = mysqli_query($this->conecta_mysql(), $update_compra);

        if($update){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='listar_compras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='listar_compras.php';</script>";
        }

    }

    function editarServico(){

        $id_pagamento = $_POST['id_pagamento'];
        $fornecedor = $_POST['emitente_nome'];
        $numero = $_POST['numero'];
        $data = $_POST['data_emissao'];
        $descricao = $_POST['descricao'];
        $classificacao = $_POST['classificacao'];
        $qtd = $_POST['qtd'];
        $unitario = $_POST['valor_unitario'];
        $valor_total = $_POST['valor_total'];
        $obra_geral = $_POST['obra_geral'];
        $empresa = $_POST['empresa'];
        $observacao = $_POST['observacao'];

        $update_servico = "UPDATE pgtos_obras
                        SET fornecedor = '$fornecedor',
                            numero = $numero,
                            data_emissao = '$data',
                            descricao = '$descricao',
                            classificacao = '$classificacao',
                            qtd = $qtd,
                            valor_unitario = $unitario,
                            valor_total = $valor_total,
                            obra_geral = '$obra_geral',
                            empresa = '$empresa',
                            observacao = '$observacao'               
                        WHERE id_pagamento = $id_pagamento ";


        $update = mysqli_query($this->conecta_mysql(), $update_servico);

        if($update){
            echo "<script type='text/javascript'>alert('Alteração efetuada com sucesso!')
                    window.location.href='listar_servicos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Erro ao efetuar a alteração!')
                    window.location.href='listar_servicos.php';</script>";
        }
    }

    function apagarCompra(){

        $id_pagamento = $_POST['id_pagamento'][0];
        $delete_compra = "DELETE FROM pgtos_obras WHERE id_pagamento = '$id_pagamento'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_compra);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='listar_compras.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='listar_compras.php';</script>";
        }
    }

    function apagarServico(){

        $id_pagamento = $_POST['id_pagamento'][0];
        $delete_compra = "DELETE FROM pgtos_obras WHERE id_pagamento = '$id_pagamento'";
        $query_delete = mysqli_query($this->conecta_mysql(), $delete_compra);

        if ($query_delete) {
            echo "<script type='text/javascript'>alert('Registro excluído com sucesso.')
                window.location.href='listar_servicos.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Ocorreu um erro ao excluir esse registro!')
                window.location.href='listar_servicos.php';</script>";
        }
    }
}
$confirma = new Confirma();
