//Номер відносної сторінки. Користувач, коли заходить на сайт, одразу знаходиться на першій відносній сторінці
var track_page = 1;

//статус завантаження (true - завантажує; false - не завантажує)
var loading  = false;

//завантаження даних (постів)
load_contents(track_page);

$(window).scroll(function() {

    //якщо користувач досягнув кінця сторінки, довантажуємо наступну відносну сторінку
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
        track_page++;
        load_contents(track_page);
    }
});

//кнопка "Load more posts" довантаження постів при натисканні на неї
$("#load_more_button").click(function (e) {
    track_page++;
    load_contents(track_page);
});

//функція завантаження даних за допомогою AJAX
function load_contents(track_page) {
    if (loading == false) {
        loading = true;

        //відобразити анімацію загрузки
        $('.loading-info').show();

        //AJAX запит
        $.post( '/Post/loadPosts', {'page': track_page}, function(data){
            loading = false;

            //якщо немає більше даних ховаємо кнопку довантаження постів
            if(data.trim().length == 0){
                $('.loading-info').hide();
                $('#load_more_button').hide();
                return;
            }

            //ховаємо анімацію загрузки
            $('.loading-info').hide();

            //добавляємо результати на головну сторінку
            $("#content").append(data);

        }).fail(function(xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        })
    }
}

