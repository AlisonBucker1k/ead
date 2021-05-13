<?php include_once(ROOT_PATH . '/assets/includes/rede/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-success text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"><?php echo 'R$ ' . number_format($saldo['saldo']); ?></h4>
                        <div>Meu Saldo.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"><?php echo $totalUsers; ?></h4>
                        <div>Ativos na rede.</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"><?php echo $indicados; ?></h4>
                        <div>Diretos</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- row 1 -->
        <div class="row pt-4">
            <div class="col-xl-12 pr-xl-2">
                <div class="card">
                    <div class="card-body">
                        <b>Link de convite:</b><br />
                        <div class="input-group mb-3">
                            <input id="url" type="text" class="form-control" placeholder="Url" aria-label="Url" value="<?php echo site_url('rede/nova_conta?&link=' . $linkCadastro['link']); ?>" readonly aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button onclick="copiarSelecao('#url', 'URL copiada com sucesso.')" type="button" class="btn btn-info"><i class="fa fa-link"></i> Copiar URL</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 2 -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Minha Assinatura</h5>
                        <?php if (isset($assinatura['id'])) {
                            echo isset($assinatura['plano']['id']) ? '<b class="text-primary">' . $assinatura['plano']['nome'] . '</b>' : '<b class="text-accent">Não possui</b>';
                        } else {
                            echo '<b class="text-accent">Não possui</b>';
                        } ?>
                        </b>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Plano de carreira</h5>
                        <?php if (isset($carreira['id'])) {
                            echo '<b class="text-primary">Ativo - R$ ' . number_format($carreira['ganho'], 2, ',', '') . '</b>';
                        } else {
                            echo '<b class="text-accent">Inativo - ';
                            if (isset($carreira['indicados'])) {
                                $indtxt = $carreira['indicados'] == 1 ? 'indicado' : 'indicados';
                                echo 'necessário ao menos ' . $carreira['indicados'] . ' ' . $indtxt . '</b>';
                            } else {
                                $atvtxt = $carreira['ativos'] == 1 ? 'ativo' : 'ativos';
                                echo 'necessário mais ' . $carreira['ativos'] . ' ' . $atvtxt . ' até o ' . $carreira['nivel'] . 'º nivel</b>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .container-coluna {
                width: calc(100% - 24px);
                min-width: calc(100% - 24px);
                max-width: calc(100% - 24px);
                position: absolute;
                bottom: 0px;
                height: 410px;
            }

            .topo-nivel {
                width: 100%;
                font-size: 1rem;
                line-height: 20px !important;
                text-align: center;
                max-height: 20px;
                padding-bottom: 5px;
            }

            .container-coluna .container-coluna-barra {
                position: absolute;
                height: auto;
                bottom: 0px!important;
                width: 100%;
            }

            .container-coluna .conteudo-coluna {
                height: 5%;
                min-height: 5%;
                position: absolute;
                bottom: 0px;
                transition: height 0.5s ease-in-out;
                text-align: center;
                width: 100%;
            }

            .container-coluna .coluna-barra {
                color: white !important;
                line-height: 0%;
                transition: all 0.5s ease-in-out;
                height: calc(100% - 20px);
            }

            .container-coluna .fundo-coluna-barra {
                transition: all 0.5s ease-in-out;
                position: absolute;
                width: 100%;
                bottom: 0px;
                background: #efefef;
                border: 1px solid #cdcdcd;
            }

            .coluna-barra .text-coluna {
                font-size: 1rem !important;
                color: black !important;
                font-weight: bolder;
            }

            .container-coluna-valor{
                width:100%;
                text-align:center;
                padding-top:5px;
                font-size:1.2rem;
            }

            @media only screen and (max-width:768px) {
                .topo-nivel {
                    font-size: 3.6vw;
                }
            }
        </style>
        <!-- row 3 -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Minha Rede</h5>
                        <div class="row" style="height:400px;">
                            <div class="col">
                                <div class="container-coluna" data-id="nv1">
                                    <div class="fundo-coluna-barra" style="height: calc(20% - 22px);"></div>
                                    <div class="conteudo-coluna">
                                        <div class="topo-nivel">1º N</div>
                                        <div class="container-coluna-barra">
                                            <div class="coluna-barra"><span class="text-coluna"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna" data-id="nv2">
                                    <div class="fundo-coluna-barra" style="height: calc(40% - 22px);"></div>
                                    <div class="conteudo-coluna">
                                        <div class="topo-nivel">2º N</div>
                                        <div class="container-coluna-barra">
                                            <div class="coluna-barra"><span class="text-coluna"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna" data-id="nv3">
                                    <div class="fundo-coluna-barra" style="height: calc(60% - 22px);"></div>
                                    <div class="conteudo-coluna">
                                        <div class="topo-nivel">3º N</div>
                                        <div class="container-coluna-barra">
                                            <div class="coluna-barra"><span class="text-coluna"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna" data-id="nv4">
                                    <div class="fundo-coluna-barra" style="height: calc(80% - 22px);"></div>
                                    <div class="conteudo-coluna">
                                        <div class="topo-nivel">4º N</div>
                                        <div class="container-coluna-barra">
                                            <div class="coluna-barra"><span class="text-coluna"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna" data-id="nv5">
                                    <div class="fundo-coluna-barra" style="height: calc(100% - 22px);"></div>
                                    <div class="conteudo-coluna">
                                        <div class="topo-nivel">5º N</div>
                                        <div class="container-coluna-barra">
                                            <div class="coluna-barra"><span class="text-coluna"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="height:30px;">
                            <div class="col">
                                <div class="container-coluna-valor" data-id="nvb1">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna-valor" data-id="nvb2">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna-valor" data-id="nvb3">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna-valor" data-id="nvb4">
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-coluna-valor" data-id="nvb5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 3 -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Faturas em aberto</h5>
                        <div class="row">
                            <div class="col-md-2">
                                <b>ID</b>
                            </div>
                            <div class="col-md-2">
                                <b>Valor</b>
                            </div>
                            <div class="col-md-2">
                                <b>Status</b>
                            </div>
                            <div class="col-md-2">
                                <b>Gerada</b>
                            </div>
                            <div class="col-md-2">
                                <b>Vencimento</b>
                            </div>
                            <div class="col-md-2">
                                <b></b>
                            </div>
                        </div>
                        <?php
                        if (count($faturas) > 0) {
                            foreach ($faturas as $fat) { ?>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        #<?php echo $fat['id']; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo 'R$ ' . number_format($fat['valor'], 2, ',', ''); ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo '<span class="badge badge-accent">Em aberto</span>'; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo formataDataBL($fat['criado_em']); ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php echo formataDataBL($fat['vencimento']); ?>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="<?php echo site_url('rede/faturas/pagar/' . $fat['id']); ?>">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Pagar</button>
                                        </a>
                                    </div>
                                </div>

                        <?php  }
                        } else {
                            echo '<hr><div class="row"><div class="col-12 text-center"><h4><i class="fa fa-check"></i> Nenhuma fatura em aberto!</h4></div></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- row 4 LAST DIRETOS -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ultimos Usuários Cadastrados</h5>
                        <div class="row">
                            <div class="col-6">
                                <b>ID</b>
                            </div>
                            <div class="col-6">
                                <b>Usuário</b>
                            </div>
                        </div>
                        <?php
                        if (count($lastUsers) > 0) {
                            foreach ($lastUsers as $user) { ?>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        #<?php echo $user['id']; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php echo $user['login']; ?>
                                    </div>
                                </div>

                        <?php  }
                        } else {
                            echo '<hr>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4>Que pena, sua rede ainda não possui usuários.<br/>
                                    <i class="far fa-frown" style="font-size:3rem;" aria-hidden="true"></i>
                                    </h4>
                                    <b class="text-accent">Indique usuários agora através do seu <a href="copiarSelecao(' . "'#url', 'URL copiada com sucesso.'" . ')">Link de Indicação</a></b>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- // END Page Content -->
<?php include_once(ROOT_PATH . '/assets/includes/rede/footer.php'); ?>

<script>
    var max = 100;

    function calcHeight(nv, t) {
        var max = 0;
        var nmax = 1;
        switch (nv) {
            case 1:
                max = 20;
                nmax = 5;

                break;
            case 2:
                max = 40;
                nmax = 25;
                break;
            case 3:
                max = 60;
                nmax = 125;
                break;
            case 4:
                max = 80;
                nmax = 625;
                break;
            case 5:
                max = 100;
                nmax = 3125;
                break;
            default:
                max = 0;
                nmax = 1;
        }
        var hgt = parseFloat(t) * max / nmax;
        var pct = t / nmax * 100;
        return {
            'hgt': hgt,
            'gray': pct
        };
    }

    function getColor(nv, s) {
        var c = 188;
        var l = 41;
        switch (nv) {
            case 1:
                c = 188;
                l = 41;
                break;
            case 2:
                c = 234;
                l = 67;
                break;
            case 3:
                c = 120;
                l = 45;
                break;
            case 4:
                c = 50;
                l = 50;
                break;
            case 5:
                c = 343;
                l = 49;
                break;
            default:
                c = 0;
                l = 0;
        }
        return 'hsl(' + c + ', ' + s.toFixed(0) + '%, ' + l + '%)';
    }

    function setarIntervalo($min, $max, $counter, $ele) {
        $timer = $counter;
        var indice = interval.length;
        indexAt[indice] = $min;
        $($ele).text($min);
        interval[indice] = setInterval(function() {
            indexAt[indice] += 1;
            $($ele).text(indexAt[indice]);
            if (indexAt[indice] == $max) {
                clearInterval(interval[indice]);
                indexAt[indice] = 0;
            }
        }, $timer);
    }

    var interval = [];
    var indexAt = [];


    var counter = 0;

    function counterNum($min, $max, $ele) {
        $counter = 500 / ($max - $min);

        setarIntervalo($min, $max, $counter, $ele);
    }

    function setarIntervaloValor($min, $max, $counter, $ele) {
        $timer = $counter;
        var indice = interval.length;
        indexAt[indice] = $min;
        interval[indice] = setInterval(function() {
            indexAt[indice] += 1;
            $($ele).text('R$ '+indexAt[indice].toFixed(2).toString().replace('.', ','));
            if (indexAt[indice] == $max) {
                clearInterval(interval[indice]);
                indexAt[indice] = 0;
            }
        }, $timer);
    }

    function counterValor($min, $max, $ele){
        $counter = 500 / ($max - $min);
        setarIntervaloValor($min, $max, $counter, $ele);
    }

    var ganhoResidual = <?php echo isset($config[0]['n1']) ? json_encode($config[0]) : '{}'; ?>;

    function drawBarras(nv, s) {

        var opt = calcHeight(nv, s);
        lnhgt = (opt.hgt * 390 / 100) - 20;
        var color = getColor(nv, opt.gray);
        var pastheight = opt.hgt;
        var height = opt.hgt;
        if (pastheight > 0){
            height = height < 9 ? 9 : height;
            lnhgt = lnhgt < 15 ? 15 : lnhgt;
        }
        console.log(color);
        $('.container-coluna[data-id="nv' + nv + '"] .conteudo-coluna').css({
            'height': height + '%',
            'line-height': lnhgt + 'px'
        });
        $('.container-coluna[data-id="nv' + nv + '"] .coluna-barra')
            .css({
                'background-color': color,
                'line-height': lnhgt + 'px'
            });
        if (pastheight > 0) {
            counterNum(0, s, '.container-coluna[data-id="nv' + nv + '"] .coluna-barra .text-coluna');
            var cG = typeof ganhoResidual['n'+nv] !== undefined ? ganhoResidual['n'+nv] : 0;
            cG *= s;
            counterValor(0, cG, '.container-coluna-valor[data-id="nvb' + nv + '"]');
        }
        //$().text(s);
    }

    function getBarras(nv) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "<?php echo site_url('rede/index/getNv') ?>/" + nv, true);
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var soma = this.responseText;
                drawBarras(nv, soma);
            }
        };
        xmlhttp.send();
    }


    $(document).ready(function() {
        for (var i = 1; i <= 5; i++) {
            getBarras(i);
        }
    })
</script>