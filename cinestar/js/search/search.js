function search()
{
    let filter = $('#search' ).val();
    console.log(filter);
    let rows = $( '.row');
    let cols = $('.col');
    let a = $('.title');

    console.log(cols.length)
    for( let i = 0; i < cols.length; i++)
    {
        let title = a.eq(i).html();
        console.log(title[0]);
        if (title.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
            console.log('match');
            cols.eq(i).css('display', "");
        } 
        else{
            console.log(title.toUpperCase().indexOf(filter));
            cols.eq(i).css('display', "none");
        }
    }
}