const modal = $('#tempModal')
const css = {'background-color': '#F5F5F5', 'color': '#000'}
const openModal = (e) => {
    let titletext = ""
    if (e.attr('data-var') === "")
        titletext = "ใหม่"
    else
        titletext = e.attr('data-var')

    modal.modal('show').find('.modal-body').load(e.attr('data-url'))
    modal.find('.modal-title').text('หลักสูตร : ' + titletext)
    modal.find('.modal-header').css(css)
    modal.find('.modal-footer').hide()
}

modal.on('hidden.bs.modal', () => {
    modal.find('.modal-body').text(null)
    location.reload()
})