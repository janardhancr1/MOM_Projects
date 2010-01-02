using System;
using System.Collections.Generic;
using System.Text;
using System.Data.SqlClient;
using System.Data;
using System.Web;
using BOMomburbia;

namespace DALMomburbia
{
    public class MOMUsers : MOMBase
    {
        MOMDataset.MOM_USRRow _MOM_USRRow = null;

        public MOMUsers() : base()
        {
        }

        public MOMDataset.MOM_USRRow MOM_USRRow
        {
            set { _MOM_USRRow = value; }
            get { return _MOM_USRRow; }
        }

        public void AddMOM_USRRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                if (!ExistsInMOM_USRRow())
                {
                    SqlCommand momCommand = base.GetMOMCommand();
                    momCommand.CommandText = "dbo.SP_MOM_USR_ADD";

                    momCommand.Parameters.Add("@EMAIL_ADDR", SqlDbType.NVarChar).Value = _MOM_USRRow.EMAIL_ADDR;
                    momCommand.Parameters.Add("@PASSWORD", SqlDbType.NVarChar).Value = MOMHelper.Encrypt(_MOM_USRRow.PASSWORD);
                    momCommand.Parameters.Add("@FIRST_NAME", SqlDbType.NVarChar).Value = _MOM_USRRow.FIRST_NAME;
                    momCommand.Parameters.Add("@LAST_NAME", SqlDbType.NVarChar).Value = _MOM_USRRow.LAST_NAME;
                    momCommand.Parameters.Add("@SEX", SqlDbType.NChar).Value = _MOM_USRRow.SEX;
                    momCommand.Parameters.Add("@DOB", SqlDbType.DateTime).Value = _MOM_USRRow.DOB;
                    momCommand.Parameters.Add("@DISPLAY_NAME", SqlDbType.NVarChar).Value = _MOM_USRRow.DISPLAY_NAME;
                    momCommand.Parameters.Add("@NEWLETTER", SqlDbType.Bit).Value = _MOM_USRRow.NEWLETTER;
                    momCommand.Parameters.Add("@ID", SqlDbType.BigInt).Direction = ParameterDirection.Output;

                    int affectedRows = momCommand.ExecuteNonQuery();

                    _MOM_USRRow.ID = (Int64)momCommand.Parameters["@ID"].Value;
                }
                else
                {
                    throw new MOMException("The user is already existing in our database...");
                }
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }

        private bool ExistsInMOM_USRRow()
        {
            SqlCommand momCommand = base.GetMOMCommand();
            momCommand.CommandText = "dbo.SP_MOM_USR_CHECK_BY_EMAIL_ADDR";
            momCommand.Parameters.Add("@EMAIL_ADDR", SqlDbType.NVarChar).Value = _MOM_USRRow.EMAIL_ADDR;
            int affectedRows = (int) momCommand.ExecuteScalar();

            if (affectedRows >= 1)
                return true;

            return false;
        }

        public void ActivateMOM_USRByID(string momUserID, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_ACTIVATE";
                momCommand.Parameters.Add("@ID", SqlDbType.BigInt).Value = Int64.Parse(MOMHelper.Decrypt(momUserID));
                int affectedRows = momCommand.ExecuteNonQuery();
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }

        public void LoginMOM_USRRow(bool rememberLogin, out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_LOGIN";
                momCommand.Parameters.Add("@EMAIL_ADDR", SqlDbType.NVarChar).Value = _MOM_USRRow.EMAIL_ADDR;
                momCommand.Parameters.Add("@PASSWORD", SqlDbType.NVarChar).Value = MOMHelper.Encrypt(_MOM_USRRow.PASSWORD);

                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;

                MOMDataset.MOM_USRDataTable momUserTable = new MOMDataset.MOM_USRDataTable();
                adaper.Fill(momUserTable);
                int rowsAffected = momUserTable.Rows.Count;

                if (rowsAffected == 1)
                {
                    _MOM_USRRow = (MOMDataset.MOM_USRRow)momUserTable.Rows[0];
                    HttpContext.Current.Session.Add("momUser", _MOM_USRRow);

                    if (rememberLogin)
                    {
                        HttpContext.Current.Response.Cookies["mE"].Value = MOMHelper.Encrypt(_MOM_USRRow.EMAIL_ADDR);
                        HttpContext.Current.Response.Cookies["mE"].Expires = DateTime.Now.AddMonths(1);

                        HttpContext.Current.Response.Cookies["mD"].Value = MOMHelper.Encrypt(_MOM_USRRow.PASSWORD);
                        HttpContext.Current.Response.Cookies["mD"].Expires = DateTime.Now.AddMonths(1);
                    }
                    else
                    {
                        HttpContext.Current.Response.Cookies["mE"].Expires = DateTime.Now.AddDays(-1);
                        HttpContext.Current.Response.Cookies["mD"].Expires = DateTime.Now.AddDays(-1);
                    }
                }
                else
                {
                    throw new MOMException("User Unknown");
                }
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }

        public void GetUserByName(out bool isSuccess, out string appMessage, out string sysMessage, string displayName)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_GET_BY_NAME";
                momCommand.Parameters.Add("@DISPLAY_NAME", SqlDbType.NVarChar).Value = displayName;

                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;

                MOMDataset.MOM_USRDataTable momUserTable = new MOMDataset.MOM_USRDataTable();
                adaper.Fill(momUserTable);
                int rowsAffected = momUserTable.Rows.Count;

                if (rowsAffected == 1)
                {
                    _MOM_USRRow = (MOMDataset.MOM_USRRow)momUserTable.Rows[0];
                }
                else
                {
                    throw new MOMException("User Unknown");
                }
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }

        public void UpdatePicture(out bool isSuccess, out string appMessage, out string sysMessage, 
            long momUserId, string picture)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_USR_PIC_UPD_BY_MOM_USR_ID";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = momUserId;
                momCommand.Parameters.Add("@PICTURE", SqlDbType.VarChar).Value = picture;

                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;
                momCommand.ExecuteNonQuery();
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }


        public void UpdateInterest(out bool isSuccess, out string appMessage, out string sysMessage, string momUsrInterest, long momUserId)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_USR_INTEREST_UPDATE";
                momCommand.Parameters.Add("@MOM_USR_INTEREST", SqlDbType.Text).Value = momUsrInterest;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = momUserId;

                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;
                momCommand.ExecuteNonQuery();
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }

        public void UpdateDetails(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_USR_BASICS_UPDATE";
                momCommand.Parameters.Add("@COUNTRY", SqlDbType.NVarChar).Value = _MOM_USRRow.COUNTRY;
                momCommand.Parameters.Add("@ZIP", SqlDbType.NVarChar).Value = _MOM_USRRow.ZIP;
                momCommand.Parameters.Add("@LOCATION", SqlDbType.NVarChar).Value = _MOM_USRRow.LOCATION;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USRRow.ID;

                SqlDataAdapter adaper = new SqlDataAdapter();
                adaper.SelectCommand = momCommand;
                momCommand.ExecuteNonQuery();
            }
            catch (MOMException X)
            {
                isSuccess = false;
                appMessage = X.Message;
            }
            catch (SqlException X)
            {
                isSuccess = false;
                appMessage = "Database Error!";
                sysMessage = X.Message;
            }
            catch (Exception X)
            {
                isSuccess = false;
                appMessage = "Application Error!";
                sysMessage = X.Message;
            }
            finally
            {
                base.CloseConnection();
            }
        }
    }
}
