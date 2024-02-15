
import axiosClient from '../plugins/axios'

export const HasEmailInDB = async (email) => {

    if (email == '') return true;
    if (HasEmail(email) == null) return true;

    let HasEmailInDB = true

    await axiosClient.get(`/User/Has/Email/${email}`)
        .then(({ data }) => {
            HasEmailInDB = !data.data
        })
        .catch(() => HasEmailInDB = false)

    return HasEmailInDB
}

function HasEmail(email) {
    return String(email)
        .toLowerCase()
        .match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)
}