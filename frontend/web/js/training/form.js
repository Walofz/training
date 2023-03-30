const addedData = () => {
    const id = $(".cos_select option:selected").val()
    if (id.length === 8) {
        $.getJSON('/course/getdetail', {id: id}, (res) => {
            // let cost = res['Course_Cost'] ?? 0
            let extdoc = res['Document_ID'] ?? ""

            // $(".txtcourse").val(cost)
            $(".txtdoc").val(extdoc)
        })
    }
}

// const getEmpCounted = (cost) => {
//     const id = $(".recid").val()
//     if (id.length > 0) {
//         $.getJSON('/training/getdetail', {id: id}, (res) => {
//             console.log(res)
//             let total = res ?? 0
//             let totalcalc = cost / total
//             console.log(totalcalc)
//             $(".txttotal").val(total.toFixed(2))
//         })
//     }
// }

$(document).ready(() => {
    addedData()
    // getEmpCounted()
})