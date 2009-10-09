using System;
using System.Collections.Generic;
using System.Text;
using System.Web.Mail;
using System.Configuration;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMNotifications
    {
        MailMessage momMail = null;

        public MOMNotifications()
        {
            momMail = new MailMessage();
        }

        public void EmailRegistrationNotification(MOMDataset.MOM_USRRow myMOM_USRRow)
        {
            string rootPath = "http://www.momburbia.com/MOMLogin/";
            //rootPath = "http://localhost:2229/MomWeb/MOMLogin/";

            string momUserID = MOMHelper.Encrypt(myMOM_USRRow.ID.ToString());

            string emailContent = "Welcome <strong>" + myMOM_USRRow.FIRST_NAME + " " + myMOM_USRRow.LAST_NAME + "</strong><br><br>" +
                                   "Thank you for your registration on Momburbia.com" + "<br><br>" +
                                   "Your registration has been confirmed, Now you can avail of the Momburbia info." +
                                   "To validate your account, click on the link below." + "<br><br>" +
                                   "<a href='" + rootPath + "MOMLogin.aspx?momUserID=" + momUserID + "' target='_blank'>momburbia.com</a><br><br>" +
                                   "<strong>Login Id&nbsp;:</strong> " + myMOM_USRRow.EMAIL_ADDR  + "<br>" +
                                   "<strong>Password&nbsp;: </strong>" + myMOM_USRRow.PASSWORD + "<br><br>" +
                                   "After logging in,you can change your password by selecting Update Your Profile under My Account section. <br><br>" +
                                   "NOTE: For security reasons this will be the only link you will ever receive from momburbia <br>" +
                                   "Site policy is never to send links back to the Momburbia.com <br>" +
                                   "Thank you.";

            //emailContent = MOMHelper.GetURLContent(url);

            momMail.To = myMOM_USRRow.EMAIL_ADDR;
            //momMail.From = ConfigurationManager.AppSettings["momAdmimEmail"];
            momMail.From = "admin@momburbia.com";
            momMail.Subject = "Momburbia Registraction Confirmation";
            momMail.BodyFormat = MailFormat.Html;
            momMail.Body = emailContent;
            momMail.Fields["http://schemas.microsoft.com/cdo/configuration/sendusing"] = 2;
            momMail.Fields["http://schemas.microsoft.com/cdo/configuration/smtpserver"] = "mail.momburbia.com";// ConfigurationManager.AppSettings["momSMTP"];
            momMail.Fields["http://schemas.microsoft.com/cdo/configuration/sendusername"] = "admin@momburbia.com";// ConfigurationManager.AppSettings["momAdmimEmail"];
            momMail.Fields["http://schemas.microsoft.com/cdo/configuration/sendpassword"] = "MOM_SYSTEM";// ConfigurationManager.AppSettings["momAdminPassword"];
            momMail.Fields["http://schemas.microsoft.com/cdo/configuration/smtpauthenticate"] = 1;

            SmtpMail.SmtpServer = ConfigurationManager.AppSettings["momSMTP"];
            SmtpMail.Send(momMail);
        }
    }
}
