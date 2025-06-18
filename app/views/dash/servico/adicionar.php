<style>
    .foto-servico {
        width: 100%;
    }
</style>
 
<div class="container-fluid">
    <div class="row">
        <div class="col-3">

            <!-- IMAGEM -->
            <img id="preview-img" class="foto-servico" src="http://localhost/kioficina/public/assets/img/logoKiOficina.svg" alt="">
            <input type="file" name="foto_galeria" id="foto_galeria" accept="image/*">
        </div>
        <div class="col-9">
            
            <!-- FORMULÁRIO DE CADASTRO -->
            <div class="mb-3">
                <label for="inputEmail4" class="form-label">Nome do Serviço:</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
 
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descrição do Serviço:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
 
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="inputEmail4" class="form-label">Preço Base:</label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col">
                        <label for="inputEmail4" class="form-label">Tempo Estimado:</label>
                        <input type="time" class="form-control" placeholder="Last name" aria-label="Last name">
                    </div>
                    <div class="col">
                        <label for="inputEmail4" class="form-label">Status do Serviço:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="Ativo">Ativo</option>
                            <option value="Desativado">Desativado</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4" class="form-label">Especialidade Existente:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>-- Selecione --</option>
                            <?php foreach($especialidades as $linha): ?>
                            <option value="<?php echo $linha['id_especialidade']; ?> "><?php echo $linha['nome_especialidade']; ?> </option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                </div>
            </div>
 
            <div class="mb-3">
                <label for="inputEmail4" class="form-label">Se não existir a especialidade desejada, informe no campo:</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
 
            <div class="mb-3">
                <button type="button" class="btn btn-success">Salvar</button>
                <button type="button" class="btn btn-secondary">Cancelar</button>
            </div>
        </div>
    </div>
</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visualizarImg = document.getElementById('preview-img');
        const arquivo = document.getElementById('foto_galeria');
 
        visualizarImg.addEventListener('click', function() {
            arquivo.click()
        });
 
        arquivo.addEventListener('change', function() {
            if (arquivo.files && arquivo.files[0]) {
                let render = new FileReader();
                render.onload = function(e) {
                    visualizarImg.src = e.target.result
                }
 
                render.readAsDataURL(arquivo.files[0]);
            }
        })
    });

</script>