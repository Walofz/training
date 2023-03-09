const addedData = () => {
    const text = $(".doc_select option:selected").text()
    let ar_text = text.split("|")
    if (ar_text.length === 2) {
        $(".course_name").text(ar_text[1].trim())
    }
}