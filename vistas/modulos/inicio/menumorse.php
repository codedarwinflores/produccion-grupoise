<style>
    .nav-item.active .nav-link {
        background-color: #f6af0f !important;
        cursor: pointer !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var enlaces = document.querySelectorAll(".nav-tabs .nav-link");

        for (var i = 0; i < enlaces.length; i++) {
            enlaces[i].addEventListener("click", function(event) {
                var parentTreeview = this.closest(".treeview");
                if (parentTreeview) {
                    parentTreeview.classList.add("active");
                }
            });
        }

        // Activar elemento de la barra lateral basado en la URL actual
        for (var i = 0; i < enlaces.length; i++) {
            if (window.location.pathname.includes(enlaces[i].getAttribute("href"))) {
                enlaces[i].parentNode.classList.add("active");
                var parentTreeview = enlaces[i].closest(".treeview");
                if (parentTreeview) {
                    parentTreeview.classList.add("active");
                }
                break;
            }
        }
    });
</script>

<ul class="nav nav-tabs" role="tablist" style="font-size: 12px;">
    <li class="nav-item">
        <a class="nav-link" href="tipoExamen" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-file-text-o"></i> Tipo de Examen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="preguntasgenerales" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-question"></i> Preguntas Generales</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="formatoexamenes" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-question-circle-o"></i> Formato Examenes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="cargoclientearea" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-briefcase"></i> Maestro Cargos y Area Examen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="vendedormorse" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-user-md"></i> Vendedor</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="clientemorse" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-users"></i> Clientes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="evaluados" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-user-plus"></i> Evaluados</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="programarexamen" style="background: #08193E; color: #FFF;" aria-expanded="false"><i class="fa fa-file-text-o"></i> Programar Examen</a>
    </li>
</ul>