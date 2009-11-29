using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Text;
using BOMomburbia;


namespace DALMomburbia
{
    public class MOMUserFavorites : MOMBase
    {
        MOMDataset.MOM_USR_FAVDataTable _MOM_USR_FAVDataTable = new MOMDataset.MOM_USR_FAVDataTable();
        public MOMDataset.MOM_USR_FAVDataTable MOM_USR_FAVDataTable
        {
            get { return _MOM_USR_FAVDataTable; }
        }

        MOMDataset.MOM_USR_FAVRow _MOM_USR_FAVRow;
        public MOMDataset.MOM_USR_FAVRow MOM_USR_FAVRow
        {
            get { return _MOM_USR_FAVRow; }
            set { _MOM_USR_FAVRow = value; }
        }

        public void GetMOM_User_Favorites(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_GET_MOM_USR_FAV";
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USR_FAVRow.MOM_USR_ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_USR_FAV.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_USR_FAVRow = momData.MOM_USR_FAV[0];
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

        public void UpdateMOM_UserFavRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_USR_FAV_UPDATE";

                if (!_MOM_USR_FAVRow.IsMOM_FAV_CELEBNull())
                    momCommand.Parameters.Add("@MOM_FAV_CELEB", SqlDbType.Text).Value = _MOM_USR_FAVRow.MOM_FAV_CELEB;
                if (!_MOM_USR_FAVRow.IsMOM_FAV_MOVNull())
                    momCommand.Parameters.Add("@MOM_FAV_MOV", SqlDbType.Text).Value = _MOM_USR_FAVRow.MOM_FAV_MOV;
                if (!_MOM_USR_FAVRow.IsMOM_FAV_TVNull())
                    momCommand.Parameters.Add("@MOM_FAV_TV", SqlDbType.Text).Value = _MOM_USR_FAVRow.MOM_FAV_TV;
                if (!_MOM_USR_FAVRow.IsMOM_FAV_BOOKSNull())
                    momCommand.Parameters.Add("@MOM_FAV_BOOKS", SqlDbType.Text).Value = _MOM_USR_FAVRow.MOM_FAV_BOOKS;
                if (!_MOM_USR_FAVRow.IsMOM_FAV_MUSICNull())
                    momCommand.Parameters.Add("@MOM_FAV_MUSIC", SqlDbType.Text).Value = _MOM_USR_FAVRow.MOM_FAV_MUSIC;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_USR_FAVRow.MOM_USR_ID;

                int affectedRows = momCommand.ExecuteNonQuery();
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
