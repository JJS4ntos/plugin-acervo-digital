<?php
namespace App\Controllers;

use App\Model\Item;

class SolicitacaoController {

  public function solicitarAcesso() {
    $itemModel = new Item();
    $item = null;
    if( isset($_POST['itemId']) ) {
        $item = $itemModel->getItem($_POST['itemId']);
        if( count($item) > 0 ) {
          $item = $item[0];
        } else {
          $item = '';
        }
    }

    $user = get_user_by( 'ID', $_POST['userId'] );
    $titulo = !empty($item->titulo)? $item->titulo : '(Sem título)['.$item->identificacao.']';
    $post_id = wp_insert_post([
      'post_title' => 'Solicitação do item "' . $titulo . '" por ' . $user->user_email,
      'post_type' => 'solicitacao',
      'post_status' => 'private'
    ]);

    update_field('identificacao_item', $item->identificacao, $post_id);
    update_field('usuario', $_POST['userId'], $post_id);
    update_field('telefone', $_POST['telefone'], $post_id);
    update_field('justificativa', $_POST['justificativa'], $post_id);
    update_field('aprovado', false, $post_id);

    $email = get_option('admin_email');
    $post = get_post($post_id);
    wp_mail( $email, $post->post_title, 'Olá, você tem uma nova solicitação de acesso para um item do seu acervo. Acesso o seu painel administrativo para autorizar o download.' );

    return 'Solicitado com sucesso!';
  }

  public function solicitarDownload() {
    $item = new Item();
    $identificacao = base64_decode($_POST['item']);
    $result = json_decode( file_get_contents('http://'. $item->getHost() .'/api/item.php?t=123&identificacao=' . $identificacao) )->result[0];
    $uploads = json_decode($result->uploads);
    $uploads = $uploads->images;
    if( !isset($_POST['userId']) ) {
      echo 'Acesso negado!';
      exit;
    }else {
      $user = get_user_by( 'ID', $_POST['userId'] );

      $result = get_posts(array(
      	'numberposts'	=> 1,
      	'post_type'		=> 'solicitacao',
      	'meta_key'		=> 'identificacao_item',
      	'meta_value'	=> $identificacao,
        'post_status' => 'private'
      ));
      if( count( $result ) < 1 ) {
        echo 'Acesso negado!';
        exit;
      }else {
        $aprovado = get_field('aprovado', $result[0]->ID);
        if( $aprovado ) {
          if( $uploads ) {
            foreach( $uploads as $upload ) {
              $link = 'http://45.76.12.210/arquivos/images/upload/'. $upload->fileName;
              header('Content-Type: application/pdf');
              header("Content-Disposition: attachment; filename={$upload->fileName}");
              header('Pragma: no-cache');
              //var_dump($link);
              readfile($link);
              exit;
            }
          }
        }
      }
    }
  }

  public function solicitarLogin() {
    if (!is_user_logged_in() && isset($_POST) ) {
      $redirect = $_POST['redirect'];
      wp_redirect( wp_login_url( $redirect ) );
      exit();
    }
  }

}
