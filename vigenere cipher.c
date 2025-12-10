#include<stdio.h>
#include<string.h>

int main(){
    char msg[100];
    char key[30];

    printf("Enter Original Message:");
    scanf("%s",msg);
    printf("\nEnter Key:");
    scanf("%s",key);

    int msgLen = strlen(msg), keyLen = strlen(key), i, j;

    char newKey[msgLen], encryptedMsg[msgLen], decryptedMsg[msgLen];

    //generating new key
    for(i = 0, j = 0; i < msgLen; ++i, ++j){
        if(j == keyLen)
            j = 0;

        newKey[i] = key[j];
    }

    newKey[i] = '\0';

    //encryption
    for(i = 0; i < msgLen; ++i)
        encryptedMsg[i] = ((msg[i] + newKey[i]) % 26) + 'A';

    encryptedMsg[i] = '\0';

    //decryption
    for(i = 0; i < msgLen; ++i)
        decryptedMsg[i] = (((encryptedMsg[i] - newKey[i]) + 26) % 26) + 'A';

    decryptedMsg[i] = '\0';

    printf("\n\nOriginal Message: %s", msg);
    printf("\n\nKey: %s", key);
    printf("\n\nNew Generated Key: %s", newKey);
    printf("\n\nEncrypted Message: %s", encryptedMsg);
    printf("\n\nDecrypted Message: %s", decryptedMsg);
    printf("\n\n");

	return 0;
}
