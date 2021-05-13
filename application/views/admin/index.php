<?php include_once(ROOT_PATH . '/assets/includes/admin/header.php'); ?>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="row">
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-success text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"><?php echo $totalAln; ?></h4>
                        <div>Total de alunos</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"> &nbsp; </h4>
                        <!--<h4 class="h2 mb-0"><?php echo $totalUsers; ?></h4>-->
                        <div>---</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-1 border-left-3 border-left-primary text-center mb-lg-0">
                    <div class="card-body">
                        <h4 class="h2 mb-0"> &nbsp; </h4>
                        <!--<h4 class="h2 mb-0"><?php echo $totalDependentes; ?></h4>-->
                        <div>---</div>
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
        <div class="row mt-4">
            
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
<?php include_once(ROOT_PATH . '/assets/includes/admin/footer.php'); ?>

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
        xmlhttp.open("GET", "<?php echo site_url('admin/index/getNv') ?>/" + nv, true);
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