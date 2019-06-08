function handleButton(event) {

    let self = $(event.currentTarget)

    let request = {
        url : self.data('action'),
        data : {},
        success : function() {
            window.location.reload()
        }
    }

    if (self.data('user-id') !== undefined) {
        request.data.userId = self.data('user-id')
    }

    console.log(request)

    $.post(request)
}

$(document).ready( function() {
    $('.ajax-button').on('click', handleButton)
})