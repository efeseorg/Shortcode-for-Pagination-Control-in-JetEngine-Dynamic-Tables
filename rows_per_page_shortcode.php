<?php
function filas_por_pagina_shortcode() {
    ob_start();
    ?>
    <div id="control-de-filas">
        <label for="filas-por-pagina">Mostrando&nbsp;</label>
        <select id="filas-por-pagina">
            <option value="10">10</option>
            <option value="20" selected>20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <label>&nbsp;por página</label>
    </div>
    <script>
    jQuery(document).ready(function($) {
        function initializePagination() {
            var $table = $('.jet-dynamic-table tbody');
            var $rows = $table.find('tr');
            var $pagination = $('#pagination-container');
            var rowsPerPage = parseInt($('#filas-por-pagina').val(), 10);

            function paginate(rows, rowsPerPage) {
                $pagination.empty();
                var numPages = Math.ceil(rows.length / rowsPerPage);

                for (var i = 1; i <= numPages; i++) {
                    var $pageLink = $('<a href="#" class="page-link">' + i + '</a>');
                    $pageLink.data('page', i);
                    $pagination.append($pageLink);
                }

                $pagination.find('.page-link').first().addClass('active');
                showPage(1);

                $pagination.find('.page-link').click(function(e) {
                    e.preventDefault();
                    var page = $(this).data('page');
                    $pagination.find('.page-link').removeClass('active');
                    $(this).addClass('active');
                    showPage(page);
                });
            }

            function showPage(page) {
                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;
                $rows.hide().slice(start, end).show();
            }

            $('#filas-por-pagina').change(function() {
                rowsPerPage = parseInt($(this).val(), 10);
                paginate($rows, rowsPerPage);
            });

            paginate($rows, rowsPerPage);
        }

        initializePagination();

        $(document).on('jet-filter-content-rendered', function() {
            initializePagination();
        });
    });
    </script>
    <style>
        #control-de-filas{display: flex;align-content: center;flex-direction: row;align-items: center;}
        #control-de-filas label{text-wrap:nowrap;}
        #control-de-filas select{font-size: 0.8em; color: var( --e-global-color-primary ); background-color: var( --e-global-color-7f82750 ); border-style: solid; border-width: 1px 1px 1px 1px; border-color: var( --e-global-color-ffc5687 ); border-radius: 3px 3px 3px 3px; padding: 10px 10px 10px 10px; -webkit-appearance: none; width: 60px}
        #pagination-container {
            margin-top: 10px;
            text-align: center;
        }
        .page-link {
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ddd;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }
        .page-link.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('filas_por_pagina', 'filas_por_pagina_shortcode');
