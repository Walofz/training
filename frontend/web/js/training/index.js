const modal = $('#tempModal')
const css = {'background-color': '#F5F5F5', 'color': '#000'}

const openModal = (e) => {
    let titletxt = ''
    if (e.attr('data-var') == '') titletxt = 'ใหม่'
    else titletxt = e.attr('data-var')

    let x
    if (x = modal) {
        x.modal('show')
        x.find('.modal-body').load(e.attr('data-url'))
        x.find('.modal-title').text('การอบรม : ' + titletxt)
        x.find('.modal-header').css(css)
        x.find('.modal-footer').hide()
    }
}

modal.on('hidden.bs.modal', () => {
    modal.find('.modal-body').text(null)
    location.reload()
})