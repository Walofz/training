const addedData = () => {
    const id = $('.empselect option:selected').val()
    const mainprod = $('.mainprod').val()
    if (id !== "") {
        $.post("/training/setempdata", {eid: id, mprod: mainprod}, (res) => {
            onLoadTable(mainprod)
        }, 'html')
    }
}

const onLoadTable = (mprod) => {
    fetch("/training/gettabledata?mprodid=" + mprod).then((res) => res.text()).then((html) => $('.table-emp tbody').html(html))
}

const onLoadData = (cosl = 1) => {
    let htmlq;
    htmlq = "<tr>"
    htmlq += "<td colspan='" + cosl + "'>"
    htmlq += "ไม่พบข้อมูล"
    htmlq += "</td>"
    htmlq += "</tr>"
    return htmlq
}

const updateStatus = (empcard, course) => {
    $.post('/training/updatestatus', {id: btoa(empcard + ":" + course)})
}

const removeData = (empcard, course) => {
    // Swal.fire({title: 'del ' + empcard + ' ?'})
    $.post('/training/removeemp', {id: btoa(empcard + ":" + course)}, (res) => {
        onLoadTable($('.mainprod').val())
    })

}

$(document).keypress((event) => {
    /* todo@ disable Enter key */
    if (event.which === 13)
        event.preventDefault()
})

$(document).ready(() => {
    $('.table-emp tbody').html(onLoadData(2))
    onLoadTable($('.mainprod').val())
})