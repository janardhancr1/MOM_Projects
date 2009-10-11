using System;
using System.Collections.Generic;
using System.Text;
using System.Text.RegularExpressions;
using System.Security.Cryptography;
using System.Web;
using System.Configuration;
using System.Net;
using System.IO;

namespace BOMomburbia
{
    public class MOMHelper
    {
        public const string MOM_RECIPE_NAMESPACE = "MOM_RECIPE";

        static string encodingText = "momBurbia";

        public static bool ValidateEmailAddress(string emailAddr)
        {
            int nFirstAT = emailAddr.IndexOf('@');
            int nLastAT = emailAddr.LastIndexOf('@');

            if ( (nFirstAT > 0) && (nLastAT == nFirstAT) &&
            (nFirstAT < (emailAddr.Length - 1)))
            {
                return (Regex.IsMatch(emailAddr, @"(\w+)@(\w+)\.(\w+)"));
            }
            else
            {
                return false;
            }
        }

        public static string Encrypt(string eString)
        {
            TripleDESCryptoServiceProvider cryptDES3 = new TripleDESCryptoServiceProvider();
            MD5CryptoServiceProvider cryptMD5 = new MD5CryptoServiceProvider();

            cryptDES3.Key = cryptMD5.ComputeHash(ASCIIEncoding.ASCII.GetBytes(encodingText));
            cryptDES3.Mode = CipherMode.ECB;

            ICryptoTransform cryptTrans = cryptDES3.CreateEncryptor();
            ASCIIEncoding asciiEncod = new ASCIIEncoding();
            Byte[] buffer = ASCIIEncoding.ASCII.GetBytes(eString);

            return Convert.ToBase64String(cryptTrans.TransformFinalBlock(buffer, 0, buffer.Length)).Replace("+", encodingText);
        }

        public static string Decrypt(string dString)
        {
            dString = dString.Replace(encodingText, "+");
            TripleDESCryptoServiceProvider cryptDES3 = new TripleDESCryptoServiceProvider();
            MD5CryptoServiceProvider cryptMD5 = new MD5CryptoServiceProvider();

            cryptDES3.Key = cryptMD5.ComputeHash(ASCIIEncoding.ASCII.GetBytes(encodingText));
            cryptDES3.Mode = CipherMode.ECB;

            ICryptoTransform cryptTrans = cryptDES3.CreateDecryptor();
            Byte[] buffer = Convert.FromBase64String(dString);

            return ASCIIEncoding.ASCII.GetString(cryptTrans.TransformFinalBlock(buffer, 0, buffer.Length));
        }

        public static string HTMLEncode(string parse)
        {
            string newParse = HttpContext.Current.Server.HtmlEncode(parse);
            return newParse;
        }

        public static string GetURLContent(string url)
        {
            String result;
            WebResponse objResponse;
            WebRequest objRequest = System.Net.HttpWebRequest.Create(url);
            objResponse = objRequest.GetResponse();
            using (StreamReader sr = new StreamReader(objResponse.GetResponseStream()))
            {
                result = sr.ReadToEnd();
                sr.Close();
            }
            return result;
        }

        public static bool IsSessionActive()
        {
            if (HttpContext.Current.Session["momUser"] == null)
                return false;
            else
                return true;
        }

        public static string BreakText(string momString, int breakLength)
        {
            if (momString.Length <= breakLength)
                return momString;

            string breakString = string.Empty;
            string[] words = momString.Split(' ');

            string temp;

            foreach (string word in words)
            {
                temp = word;
                if (word.Length > breakLength)
                    temp = BreakWord(word, breakLength);

                breakString += temp + ' ';
            }

            return breakString;
        }

        private static string BreakWord(string momString, int breakLength)
        {
            if (momString.Length <= breakLength)
                return momString;

            string breakString = string.Empty;
            string appendEnd = " ";
            int status = 0;

            int breakIndex = 0;
            while (breakIndex <= momString.Length)
            {
                if ((breakIndex + breakLength) > momString.Length)
                {
                    breakLength = momString.Length - breakIndex;
                    appendEnd = "";
                    status = 1;
                }

                breakString += momString.Substring(breakIndex, breakLength) + appendEnd;
                breakIndex += breakLength + status;
            }
            return breakString;
        }
    }
}
