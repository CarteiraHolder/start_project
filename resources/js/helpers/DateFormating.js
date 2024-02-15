export function dateFormatingWithAs(date) {
    const dateSplited = date.split(' ')
    const dateFinal = `${dateSplited[0]} às ${dateSplited[1]}`
    return dateFinal
}

export function toLocaleTimeString(date) {

    return new Date(date).toLocaleTimeString('pt-BR', { timeZone: 'America/Sao_Paulo' }).slice(0, -3)
}

export function toLocaleDateString(date) {
    let options = {
        year: '2-digit', month: '2-digit', day: '2-digit', timeZone: 'UTC'
    }
    return new Date(date).toLocaleDateString('pt-BR', options)
}