var x = document.getElementById("formPF");
var y = document.getElementById("formPJ");
var z = document.getElementById("btn");

function pessoa_fisica(){
    x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}

function pessoa_juridica(){
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0px";
}

function validarEmail(emailFieldId) {
    const emailField = document.getElementById(emailFieldId);
    const emailValue = emailField.value;

    // Verifica se o e-mail contém o caractere "@"
    if (emailValue.indexOf('@') === -1) {
        alert('O e-mail precisa conter o caractere "@".');
        return false;
    }

    // Verifica se o e-mail contém o caractere "." após o "@"
    if (emailValue.split('@')[1].indexOf('.') === -1) {
        alert('O e-mail precisa conter um ponto "."');
        return false;
    }

    // Se tudo estiver válido, retorna true para permitir o envio do formulário
    return true;
}

function formatPhoneNumber(input) {
    // Remove caracteres não numéricos
    const phoneNumber = input.value.replace(/\D/g, '');

    // Verifica se o número de telefone tem pelo menos 2 dígitos (DDD)
    if (phoneNumber.length >= 2) {
        // Adiciona os parênteses do DDD
        input.value = `(${phoneNumber.substring(0, 2)}`;

        // Verifica se o número de telefone tem mais de 2 dígitos
        if (phoneNumber.length > 2) {
            // Adiciona o próximo conjunto de dígitos e o traço
            input.value += `) ${phoneNumber.substring(2, 7)}`;
            
            // Verifica se o número de telefone tem mais de 7 dígitos
            if (phoneNumber.length > 7) {
                // Adiciona o último conjunto de dígitos e o traço
                input.value += `-${phoneNumber.substring(7, 11)}`;
            }
        }
    }
}

function formatCNPJ(input) {
    let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters

    // Limit CNPJ to 14 digits
    if (value.length > 14) {
        value = value.substring(0, 14);
    }

    // Format CNPJ
    if (value.length > 2) {
        value = value.substring(0, 2) + '.' + value.substring(2);
    }
    if (value.length > 6) {
        value = value.substring(0, 6) + '.' + value.substring(6);
    }
    if (value.length > 10) {
        value = value.substring(0, 10) + '/' + value.substring(10);
    }
    if (value.length > 15) {
        value = value.substring(0, 15) + '-' + value.substring(15);
    }

    input.value = value;
}

// Adiciona um ouvinte de evento ao campo de telefone em ambas as formas
document.getElementById("telefonePF").addEventListener("input", function() {
    // Remove caracteres não numéricos ao inserir no campo
    this.value = this.value.replace(/\D/g, '');
    // Chama a função para formatar o número
    formatPhoneNumber(this);
});

document.getElementById("telefonePJ").addEventListener("input", function() {
    // Remove caracteres não numéricos ao inserir no campo
    this.value = this.value.replace(/\D/g, '');
    // Chama a função para formatar o número
    formatPhoneNumber(this);
});

// Adiciona um ouvinte de evento ao campo de CPF
document.getElementById("cpf").addEventListener("input", function() {
    // Remove caracteres não numéricos ao inserir no campo
    let cleanedValue = this.value.replace(/\D/g, '');

    // Limita a quantidade máxima de dígitos a 11
    cleanedValue = cleanedValue.substring(0, 11);

    // Formata o CPF com pontos e traço
    if (cleanedValue.length > 3 && cleanedValue.length <= 6) {
        this.value = cleanedValue.replace(/^(\d{3})(\d{3})/, "$1.$2");
    } else if (cleanedValue.length > 6 && cleanedValue.length <= 9) {
        this.value = cleanedValue.replace(/^(\d{3})(\d{3})(\d{3})/, "$1.$2.$3");
    } else if (cleanedValue.length > 9) {
        this.value = cleanedValue.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    } else {
        this.value = cleanedValue;
    }

    // Impede que o usuário insira letras e símbolos
    if (/[^\d]/.test(cleanedValue)) {
        this.value = cleanedValue.replace(/[^\d]/g, '');
    }
});
