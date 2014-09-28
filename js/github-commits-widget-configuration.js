$(function() {
    $('#github-commits').githubInfoWidget(
        { user: 'wikimatze', repo: 'padrinobook', branch: 'master', last: 5, limitMessageTo: 30 });
});

