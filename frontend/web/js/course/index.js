const modal = $('#tempModal')
const css = {'background-color': '#F5F5F5', 'color': '#000'}
const openModal = (e) => {
    console.table(e.attr('data-url'))
    modal.modal('show').find('.modal-body').load(e.attr('data-url'))
    modal.find('.modal-title').text('หลักสูตร : [' + e.attr('data-var') + ']')
    modal.find('.modal-header').css(css)
}

modal.on('hidden.bs.modal', () => {
    modal.find('.modal-body').text(null)
    location.reload()
})