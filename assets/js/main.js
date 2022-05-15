$(function() {
    $('.specialite').DataTable();
    $('.module').DataTable();
});


(function () {
    $(document).ready(function() {
        var creditsyear = new Date();
        var year = creditsyear.getFullYear();
        styles1 = ['color: #007bff', 'font-size:20px', 'font-weight: bold'].join(';'),
            styles2 = ['color: #007bff', 'font-size:12px', 'font-weight: bold'].join(';'),
            styles3 = ['background: #007bff', 'color: #fff', 'font-size:12px', 'padding: 0 5px', 'margin: 2px 0', 'border-radius: 30px'].join(';'),
            product = 'Mon Département',
            version = '1.0',
            blog_status = true,
            by = {
                team: 'Iheb Hafdallah',
                link: 'https://www.facebook.com/ihebhafdallah1/'
            },
            console.log('%c' + product + '\n%cURL: ' + by.link + '\nBy: ' + by.team + '\nCopyright: ' + year + '\n%cStatus: ' + blog_status + '\nVersion: ' + version + '', styles1, styles2, styles3);
    });
})();