<!doctype php>
<php lang="en" dir="ltr">
<?php require 'functions_db.php'; ?>
<?php $lists = getProductList(); ?>
<!-- </?php dd($lists); ?> -->
<!-- //<//?php dd($lists); ?> -->

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="pt-br" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Venda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
    <script>
      function handleSelectProduct(e){
       const current = e.target.querySelector(`option[value='${e.target.value}']`)
       const form = document.forms['venda']  
       form.fsales_price.value= current.dataset.unitPrice
      }

      function handleTotal(){
        const form = document.forms['venda'] 
        if (!form.isales_quantity.value||!form.fsales_price.value) return
        const total = parseInt(form.isales_quantity.value) * parseFloat(form.fsales_price.value)
        form.total.value = total
      }
    </script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.php">
                <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">                
                <div>
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">Willian N</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                  </a>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 ml-auto">
                <form class="input-icon my-3 my-lg-0">
                  <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                  <div class="input-icon-addon">
                    <i class="fe fe-search"></i>
                  </div>
                </form>
              </div>
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
		  <li class="nav-item">
                    <a href="./produtos.php" class="nav-link"><i class="fe fe-package"></i> Produtos</a>
                  </li>
		  <li class="nav-item">
                    <a href="./form-venda.php" class="nav-link active"><i class="fe fe-dollar-sign"></i> Venda</a>
                  </li>
		  <li class="nav-item">
                    <a href="./produtos-excluidos.php" class="nav-link"><i class="fe fe-trash"></i> Lixeira</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">              
            <div class="col-lg-12">
              <form class="card" name="venda" action="controllers/store_sale.php" method="POST">
                <div class="card-body">
                  <h3 class="card-title">Realizar venda de um produto</h3>
                  <div class="row">
		    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Produto</label>

                        <select name="id" class="form-control custom-select" onchange="handleSelectProduct(event)">
                          <option value="">Selecione</option>
                        <?php                     
                          foreach($lists as $list) : ?>
                          <option value="<?php echo $list['idproduct'] ?>" data-unit-price="<?php echo ($list['funit_price']) ?>">
                           <?php echo htmlspecialchars($list['sdescription']) ?>
                          </option>             
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="isales_quantity" class="form-control" placeholder="Digite aqui a quantidade" onkeyup="handleTotal()">
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Valor unitário</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input type="text" name="fsales_price" class="form-control text-right" aria-label="Valor" onkeyup="handleTotal()">                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <div class="form-group">
                        <label class="form-label">Valor total</label>
                        <div class="input-group">
                          <span class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                          </span>
                          <input type="text" name="total" class="form-control text-right" aria-label="Valor" disabled="disabled" title="Este campo não pode ser alterado">                          
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                      <div class="form-group">                        
                        <div class="form-label">&nbsp;</div>
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="checkbox-venda" value="1">
                            <span class="custom-control-label">Atualizar valor unitário do produto</span>
                          </label>
			</div>
                      </div>
                    </div>                    
                  </div>
                </div>
                <div class="card-footer text-left" style="display: flex; justify-content: space-between">
		  <div>
		    <a href="./produtos.php" class="btn btn-secondary">Voltar para produtos</a>
		  </div>
		  <div>
		    <button type="submit" class="btn btn-primary">Confirmar</button>
		  </div>                                    
                </div>                
              </form>
            </div>
          </div>
        </div>
      </div>
	<div class="my-3 my-md-5">
          <div class="container">
            <div class="row row-cards row-deck">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Últimas vendas realizadas</h3>		                        
                  </div>
                  <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">#</th>
                          <th>Produto</th>
                          <th>Quantidade</th>
                          <th>Valor unitário</th>
                          <th>Valor total da venda</th>                          
                        </tr>
                      </thead>
                      <?php $produtos = getSoldProductList();
                      ?>
                      <?php foreach($produtos as $produto) : ?>
                      <tbody>
                        <tr>
                          <td><span class="text-muted"><?php echo $produto['idsales'] ?></span></td>
                          <td><?php echo htmlspecialchars($produto['sdescription']) ?></td>
                          <td><?php echo $produto['isales_quantity'] ?></td>
                          <td>
                              <?php                              
                               $fmt = new NumberFormatter( 'pt_BR', NumberFormatter::CURRENCY );
                               echo $fmt->formatCurrency($produto['fsales_price'], "BRL"); ?>
                          </td>
                          <td>
                           <?php echo $fmt->formatCurrency($produto['fsales_total'], "BRL") ?>
                          </td>                          
                        </tr> 
                      </tbody>
                      <?php endforeach; ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</body>
</php>