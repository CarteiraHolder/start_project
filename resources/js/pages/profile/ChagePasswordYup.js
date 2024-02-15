import * as yup from "yup";
import { ValidateMyPasswordInDB } from "../../helpers/ValidateMyPasswordInDB";

var passwordField = ""

const NewPasswordSchema = yup.object().shape({
    currencyPassword: yup
        .string()
        .required(`O campo senha atual é obrigatório.`)
        .min(8, 'O campo nova senha deve ter no mínimo 8 caracteres')
        .test(
            "test-password",
            "Senha inválida",
            async (password) => {
                const result = await ValidateMyPasswordInDB(password);
                return result;
            }
        ),
    newPassword: yup
        .string()
        .required(`O campo nova senha é obrigatório.`)
        .min(8, 'O campo nova senha deve ter no mínimo 8 caracteres')
        .test("set-password-fild", "Os dois campos de nova senha devem ser iguais", (password) => {
            passwordField = password
            return true
        }),
    repeatNewPassword: yup
        .string()
        .required(`O campo repita sua nova senha é obrigatório`)
        .test("test-invalid-password", "O campos de nova senha devem ser igual ao repita sua nova senha", (rePassword) => passwordField == rePassword),
});

export default NewPasswordSchema;