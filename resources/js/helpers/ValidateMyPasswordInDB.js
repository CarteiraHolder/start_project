
import axiosClient from '../plugins/axios'

export const ValidateMyPasswordInDB = async (password) => {
    if (!password) return true
    if (password.length < 8) return true

    let ValidateMyPasswordInDB = true

    await axiosClient.get(`/User/Teste/Password/${password}`)
        .then(({ data }) => {
            ValidateMyPasswordInDB = data.data
        })
        .catch(() => ValidateMyPasswordInDB = false)


    return ValidateMyPasswordInDB
}