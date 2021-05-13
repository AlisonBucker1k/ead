<div class="card mb-32pt mb-lg-64pt">
    <div class="card-title pl-4 pt-2">
        <h5><?php echo $item['curso']['nome'] ?></h5>
    </div>
    <div class="card-body">
            <div class="row">
                <?php foreach($item['provas'] as &$prova): ?>
                    <div class="col text-center">
                        <b><?php echo $prova['nome'] ?></b>
                    </div>
                <?php endforeach; ?>
                <div class="col text-center">
                    <b>Média Final</b>
                </div>
                <div class="col text-center">
                    <b>Nota Máxima</b>
                </div>
            </div>
            <hr>
            <div class="row">
                <?php foreach($item['provas'] as &$prova): ?>
                    <div class="col text-center <?php echo $prova['notaAluno']['classe'] ?? ""; ?>">
                        <?php echo $prova['notaAluno']['nota'] ?? "N/A"; ?>
                    </div>
                <?php endforeach; ?>
                <div class="col text-center <?php echo $item['classe']; ?>">
                    <?php echo $item['media']; ?>
                </div>
                <div class="col text-center">
                    <b><?php echo $item['nota_maxima']; ?></b>
                </div>
            </div>
    </div>
</div>