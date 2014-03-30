$(function() {
    $('#github-commits').githubInfoWidget(
        { user: 'matthias-guenther', repo: 'padrinobook', branch: 'master', last: 5, limitMessageTo: 30 });
});

