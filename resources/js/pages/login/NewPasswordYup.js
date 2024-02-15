import * as yup from "yup";
import { CpfIsInvalid } from "../../helpers/CpfIsInvalid";
import { HasCpfInDB } from "../../helpers/HasCpfInDB";
import { HasEmailInDB } from "../../helpers/HasEmailInDB";

var passwordField = ""

const NewPasswordSchema = yup.object().shape({
    password: yup
        .string()
        .required(`O campo senha é obrigatório.`)
        .min(8, 'O campo senha deve ter no mínimo 8 caracteres')
        .test("set-password-fild", "Os dois campos de senha devem ser iguais", (password) => {
            passwordField = password
            return true
        }),
    rePassword: yup
        .string()
        .required(`O campo repita sua senha é obrigatório`)
        .test("test-invalid-password", "Os dois campos de senha devem ser iguais", (rePassword) => passwordField == rePassword),
});

export default NewPasswordSchema;