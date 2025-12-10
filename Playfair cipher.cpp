#include <bits/stdc++.h>
using namespace std;

// Function to convert the string to lowercase
void toLowerCase(string &plain) {
    int n = plain.size();
    for (int i = 0; i < n; i++) {
        if (plain[i] > 64 && plain[i] < 91)
            plain[i] += 32;
    }
}

// Function to remove all spaces in a string
void removeSpaces(string &plain) {
    int n = plain.size();
    string temp;
    for (int i = 0; i < n; i++) {
        if (plain[i] != ' ') {
            temp += plain[i];
        }
    }
    plain = temp;
}

// Function to generate the 5x5 key square
void generateKeyTable(string &key,
        vector<vector<char>> &keyT) {
    int n = key.size();

    // 5x5 key table
    keyT.resize(5, vector<char>(5, 0));

    // a 26 character hashmap
    // to store count of the alphabet
    vector<int> hash(26, 0);

    int i, j, k, flag = 0;
    for (i = 0; i < n; i++) {
        if (key[i] != 'j')
            hash[key[i] - 97] = 2;
    }

    hash['j' - 97] = 1;

    i = 0;
    j = 0;

    for (k = 0; k < n; k++) {
        if (hash[key[k] - 97] == 2) {
            hash[key[k] - 97] -= 1;
            keyT[i][j] = key[k];
            j++;
            if (j == 5) {
                i++;
                j = 0;
            }
        }
    }

    for (k = 0; k < 26; k++) {
        if (hash[k] == 0) {
            keyT[i][j] = (char)(k + 97);
            j++;
            if (j == 5) {
                i++;
                j = 0;
            }
        }
    }
}

// Function to search for the characters of a digraph
// in the key square and return their position
void search(vector<vector<char>> &keyT,
        char a, char b, vector<int> &arr) {
    int i, j;

    if (a == 'j')
        a = 'i';
    else if (b == 'j')
        b = 'i';

    for (i = 0; i < 5; i++) {

        for (j = 0; j < 5; j++) {

            if (keyT[i][j] == a) {
                arr[0] = i;
                arr[1] = j;
            }
            else if (keyT[i][j] == b) {
                arr[2] = i;
                arr[3] = j;
            }
        }
    }
}

// Function to make the plain text length to be even
int prepare(string &str) {
    if (str.size() % 2 != 0) {
        str += 'z';
    }
    int n = str.size();
    return n;
}

// Function for performing the encryption
void encrypt(string &str, vector<vector<char>> &keyT) {
    int n = str.size();
    vector<int> arr(4);

    for (int i = 0; i < n; i += 2) {

        search(keyT, str[i], str[i + 1], arr);

        if (arr[0] == arr[2]) {
            str[i] = keyT[arr[0]][(arr[1] + 1) % 5];
            str[i + 1] = keyT[arr[0]][(arr[3] + 1) % 5];
        }
        else if (arr[1] == arr[3]) {
            str[i] = keyT[(arr[0] + 1) % 5][arr[1]];
            str[i + 1] = keyT[(arr[2] + 1) % 5][arr[1]];
        }
        else {
            str[i] = keyT[arr[0]][arr[3]];
            str[i + 1] = keyT[arr[2]][arr[1]];
        }
    }
}

// Function to encrypt using Playfair Cipher
void encryptByPlayfairCipher(string &str, string &key) {
    vector<vector<char>> keyT;
    removeSpaces(key);
    toLowerCase(key);
    toLowerCase(str);
    removeSpaces(str);
    prepare(str);
    generateKeyTable(key, keyT);
    encrypt(str, keyT);
}

int main() {
    string key; //= "Monarchy";
    string str; //= "instruments";
    cout<<"Enter Key text: ";
    cin>>key;
    cout<<"Enter Plaintext:";
    cin>>str;
    //cout << "Key text: " << key << endl;
    //cout << "Plain text: " << str << endl;
    encryptByPlayfairCipher(str, key);
    cout << "Cipher text: " << str << endl;
    return 0;
}
