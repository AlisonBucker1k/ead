    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div class="container_imagem" style="background-image:url('<?php echo 'https://api.moneybemoney.com/uploads/' . $sorteio[0]['img_prod']; ?>')">
                </div>
            </div>
            <div class="col-sm-5" style="padding-left:15px;padding-right:15px;">
                <div class="card" style="width: 100%;height:400px;">
                    <div class="card-body">
                        <h1 class="card-title" style="margin-bottom: 2rem;font-weight: 900;"><?php echo $sorteio[0]['nome_prod']; ?></h1>
                        <div class="row">
                            <div class="col bl tl">VALUE</div>
                            <div class="col bl tl">QUOTA</div>
                            <?php if (isset($sorteio[0]['data_encerra'])) { ?><div class="col bl tl">GIVEAWAY</div><?php } ?>
                        </div>
                        <div class="row" style="margin-top:-25px;">
                            <div class="col bl"><?php echo '$ ' . number_format($sorteio[0]['val_prod'], 2, ',', '.') ?></div>
                            <div class="col bl"><?php echo '$ ' . $sorteio[0]['val_cota']; ?></div>
                            <?php if (isset($sorteio[0]['data_encerra'])) { ?><div class="col bl"><?php echo explode(' ', $sorteio[0]['data_encerra'])[0]; ?></div><?php } ?>
                        </div>
                        <div class="row full-wdt" style="    margin-top: 30px;">
                            <div class="col pd0">
                                <div class="container_barra">
                                    <div class="barra_insider" style="width:<?php echo round($pctQ, 2); ?>%;"></div>
                                    <div class="texto_barra"><?php echo round($pctQ, 2); ?>% of the 100% target</div>
                                </div>
                            </div>
                        </div>
                        <div class="row full-wdt" style="margin-top: -20px; height: 157px; background-color:#e0e7ed;border-bottom-left-radius: .25rem;border-bottom-right-radius: .25rem;padding: 30px 15px;padding-top:20px;">
                            <div class="col pd0">
                                <?php if (isset($sorteio[0]['data_encerra'])) { ?>
                                    <div class="container_encerra" style="padding-bottom: 10px;color:#839bab"><b>Finishes in</b></div>
                                    <div class="row">
                                        <div id="dd" class="col col_timer"><?php echo $dias; ?><br /><small>days</small></div>
                                        <div id="hh" class="col col_timer"><?php echo $hh; ?><br /><small>hours</small></div>
                                        <div id="mm" class="col col_timer"><?php echo $mm; ?><br /><small>minutes</small></div>
                                        <div id="ss" class="col col_timer"><?php echo $ss; ?><br /><small>seconds</small></div>
                                    </div>
                                <?php } else { ?>
                                    <div class="container_encerra encerra-middle">Finishes when all raffles are sold</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container-legenda">
            <div class="box-legenda">
                <div class="bx-lg bx-livre"></div> <span class="texto-bx">FREE</span>
            </div>
            <div class="box-legenda">
                <div class="bx-lg bx-pago"></div> <span class="texto-bx">PAID</span>
            </div>
            <div class="box-legenda">
                <div class="bx-lg bx-comprado"></div> <span class="texto-bx">BOUGHT</span>
            </div>
            <div class="box-legenda">
                <div class="bx-lg bx-selecionado"></div> <span class="texto-bx">SELECTED</span>
            </div>
        </div>
        <br />
        <?php echo $sorteio[0]['htmlNumeros']; ?>


    </div>
    <div class="row full-wdt bottom_bar" style="margin:auto;">
        <div class="conteudo_bottom">
            <div class="val_ttl">
                <div class="total_txt">Total: </div>
                <div id="val_total">$0</div>
            </div>
            <button class="btn btn_participar" onclick="participar();">Participate</button>
        </div>
    </div>
    <script>
        <?php if (isset($sorteio[0]['data_encerra'])) { ?>
            

            function tempoCorrente() {
                var dateFuture = new Date('<?php echo $sorteio[0]['data_encerra'] ?>');
                var dateNow = new Date();

                var seconds = Math.floor((dateFuture - (dateNow)) / 1000);
                var minutes = Math.floor(seconds / 60);
                var hours = Math.floor(minutes / 60);
                var days = Math.floor(hours / 24);

                hours = hours - (days * 24);
                minutes = minutes - (days * 24 * 60) - (hours * 60);
                seconds = seconds - (days * 24 * 60 * 60) - (hours * 60 * 60) - (minutes * 60);

                $('#dd').html(`${days}<br/><small>days</small>`);
                $('#hh').html(`${hours}<br/><small>hours</small>`);
                $('#mm').html(`${minutes}<br/><small>minutes</small>`);
                $('#ss').html(`${seconds}<br/><small>seconds</small>`);
            }

            $(document).ready(function() {
                window.setInterval(tempoCorrente, 1000);
            });
        <?php } ?>
        var idsenvio = "";
            function participar(){
                $('.btn-selecionado').each(function() {
                    idsenvio += idsenvio != "" ? "|" + $(this).prop('id') : $(this).prop('id');
                });
                var form = `<form id="form_compra" method="post" action="<?php echo site_url('painel/comprar/'.$sorteio[0]['id']); ?>" style="display:none;" >
                    <input name="numeros" value="${idsenvio}" />
                </form>`;
                $('body').append(form);
                $('#form_compra').submit();
            }
            
        var valQuota = <?php echo $sorteio[0]['val_cota']; ?>;

            function calculaValor() {
                var valtotal = 0;
                $('.btn-selecionado').each(function() {
                    valtotal += valQuota + (0.1 * valQuota);
                });
                $('#val_total').text("$" + valtotal);
            }

            function addRemove(obj) {
                if (obj.hasClass('btn-selecionado')) {
                    obj.removeClass('btn-selecionado');
                } else {
                    obj.addClass('btn-selecionado');
                }
                calculaValor();
            }
    </script>