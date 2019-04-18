var DatatablesBasicBasic = {
    init: function() {
        $("#m_table_1").DataTable({
            responsive: !0,
            order: [
                [0, "asc"]
            ]
        });
    }
};
jQuery(document).ready(function() {
    DatatablesBasicBasic.init()
});