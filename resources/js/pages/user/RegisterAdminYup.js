import * as yup from "yup";
import { CpfIsInvalid } from "../../helpers/CpfIsInvalid";
import { HasCpfInDB } from "../../helpers/HasCpfInDB";
import { HasEmailInDB } from "../../helpers/HasEmailInDB";
import { RoleEnum } from "../../helpers/RoleEnum";

const RegisterSchema = yup.object().shape({
    name: yup
        .string()
        .required(`O campo nome é obrigatório.`),
    cpf: yup
        .string()
        .required(`O campo CPF é obrigatório`)
        .test("test-invalid-cpf", "O campo CPF inválido", (cpf) =>
            CpfIsInvalid(cpf)
        )
        .test(
            "test-cpf",
            "CPF já cadastrado",
            async (cpf) => {
                const result = await HasCpfInDB(cpf);
                return result;
            }
        ),
    // email: yup
    //     .string()
    //     .email(`O campo email é inválido`)
    //     .required(`O campo email é obrigatório`)
    //     .test(
    //         "test-email",
    //         "Email já cadastrado",
    //         async (email) => {
    //             const result = await HasEmailInDB(email);
    //             return result;
    //         }
    //     ),
    role: yup
        .object()
        .nullable("O campo permissão é obrigatório")
        .test(
            "test-invalid-role",
            "O campo permissão é obrigatório",
            (role) => role?.id !== undefined
        ),
    contractor: yup
        .object()
        .nullable("O campo contratante é obrigatório")
        .when(['role'], {
            is: (role) => (role?.id !== RoleEnum.admin && role?.id !== undefined),
            then: schema => schema
                .test(
                    "test-invalid-contractor",
                    "O campo contratante é obrigatório",
                    (contractor) => contractor?.id !== undefined,
                ),
            otherwise: schema => schema.optional(),
        }),
    // flag: yup
    //     .object()
    //     .nullable("O campo bandeira é obrigatório")
    //     .when(['role'], {
    //         is: (role) => (
    //             role?.id == RoleEnum.flagBuyer ||
    //             role?.id == RoleEnum.flagInCharge ||
    //             role?.id == RoleEnum.flagManager
    //         ),
    //         then: schema => schema
    //             .test(
    //                 "test-invalid-flag",
    //                 "O campo bandeira é obrigatório",
    //                 (flag) => flag?.id !== undefined,
    //             ),
    //         otherwise: schema => schema.optional(),
    //     }),
    // industry: yup
    //     .object()
    //     .nullable("O campo bandeira é obrigatório")
    //     .when(['role'], {
    //         is: (role) => (
    //             role?.id == RoleEnum.industryCommercialRepresentative ||
    //             role?.id == RoleEnum.industryManager ||
    //             role?.id == RoleEnum.industrySeller
    //         ),
    //         then: schema => schema
    //             .test(
    //                 "test-invalid-industry",
    //                 "O campo industria é obrigatório",
    //                 (industry) => industry?.id !== undefined,
    //             ),
    //         otherwise: schema => schema.optional(),
    //     }),

});

export default RegisterSchema;