<script>
    $(function () {
        var rows = @json($rows);
        var counter = 0;
        var $body = $('#items-body');
        var template = document.getElementById('row-template').innerHTML;

        function fmt(n) { return (Math.round(n * 100) / 100).toFixed(2); }

        function recalc() {
            var subtotal = 0;
            $body.find('tr').each(function () {
                var qty  = parseFloat($(this).find('.item-qty').val()) || 0;
                var cost = parseFloat($(this).find('.item-cost').val()) || 0;
                var line = Math.round(qty * cost * 100) / 100;
                $(this).find('.item-total').text(fmt(line));
                subtotal += line;
            });
            subtotal = Math.round(subtotal * 100) / 100;
            var dp = Math.min(100, Math.max(0, parseFloat($('#discount_percent').val()) || 0));
            var tp = Math.min(100, Math.max(0, parseFloat($('#tax_percent').val()) || 0));
            // نفس معادلة السيرفر: الخصم الأول، والضريبة على المبلغ بعد الخصم
            var discount = Math.round(subtotal * dp) / 100;
            var taxable = subtotal - discount;
            var tax = Math.round(taxable * tp) / 100;
            $('#subtotal-view').text(fmt(subtotal));
            $('#discount-view').text(fmt(discount));
            $('#tax-view').text(fmt(tax));
            $('#total-view').text(fmt(taxable + tax));
        }

        function addRow(data) {
            data = data || {};
            var $row = $(template.replace(/__IDX__/g, counter++));
            if (data.material_id) {
                $row.find('.item-material').val(data.material_id);
                $row.find('.item-unit').text($row.find('.item-material option:selected').data('unit') || '');
            }
            if (data.ordered_quantity !== undefined) $row.find('.item-qty').val(data.ordered_quantity);
            if (data.unit_cost !== undefined) $row.find('.item-cost').val(data.unit_cost);
            $body.append($row);
        }

        $('#add-item').on('click', function () { addRow(); });

        $body.on('click', '.remove-item', function () {
            if ($body.find('tr').length > 1) {
                $(this).closest('tr').remove();
                recalc();
            }
        });

        $body.on('change', '.item-material', function () {
            var $opt = $(this).find('option:selected');
            var $tr = $(this).closest('tr');
            $tr.find('.item-unit').text($opt.data('unit') || '');
            // سعر الخامة الافتراضي لو الخانة فاضية
            if (!$tr.find('.item-cost').val()) {
                $tr.find('.item-cost').val($opt.data('cost') || 0);
            }
            recalc();
        });

        $body.on('input', '.item-qty, .item-cost', recalc);
        $('#tax_percent, #discount_percent').on('input', recalc);

        rows.forEach(addRow);
        recalc();
    });
</script>
