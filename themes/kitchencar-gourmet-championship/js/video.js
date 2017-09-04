$(function() {
	var getWindowMovieHeight = function() {
		// ここでブラウザの縦横のサイズを取得します。
		var windowSizeHeight = $(window).outerHeight();
		var windowSizeWidth = $(window).outerWidth();

		// メディアの縦横比に合わせて数値は変更して下さい。(メディアのサイズが width < heightの場合で書いています。逆の場合は演算子を逆にしてください。)
		var windowMovieSizeWidth = windowSizeHeight * 1.76388889;
		var windowMovieSizeHeight = windowSizeWidth / 1.76388889;
		var windowMovieSizeWidthLeftMargin = (windowMovieSizeWidth - windowSizeWidth) / 2;

		if (windowMovieSizeHeight < windowSizeHeight) {
			// 横幅のほうが大きくなってしまう場合にだけ反応するようにしています。
			$("#video").css({left: -windowMovieSizeWidthLeftMargin});
		}
	};

	// 以下画面の可変にも対応できるように。
	$(window).on('load', function(){
		getWindowMovieHeight();
	});

	$(window).on('resize', function(){
		getWindowMovieHeight();
	});
});