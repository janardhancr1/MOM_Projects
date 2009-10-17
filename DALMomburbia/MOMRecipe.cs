using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Text;
using System.Data;
using BOMomburbia;
using System.Web;

namespace DALMomburbia
{
    public class MOMRecipe : MOMBase
    {
        MOMDataset.MOM_RCPDataTable _MOM_RCPDataTable = new MOMDataset.MOM_RCPDataTable();
        public MOMDataset.MOM_RCPDataTable MOM_RCPDataTable
        {
            get { return _MOM_RCPDataTable; }
        }

        MOMDataset.MOM_RCPRow _MOM_RCPRow;
        public MOMDataset.MOM_RCPRow MOM_RCPRow
        {
            get { return _MOM_RCPRow; }
            set { _MOM_RCPRow = value; }
        }

        private MOMDataset.MOM_TAGSRow _MOM_TAGSRow;
        public MOMDataset.MOM_TAGSRow MOM_TAGSRow
        {
            get { return _MOM_TAGSRow; }
            set { _MOM_TAGSRow = value; }
        }

        public void AddMOM_RCPRow(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_ADD";

                momCommand.Parameters.Add("@NAME", SqlDbType.VarChar).Value = _MOM_RCPRow.NAME;
                momCommand.Parameters.Add("@DESCRIPTION", SqlDbType.VarChar).Value = _MOM_RCPRow.DESCRIPTION;
                momCommand.Parameters.Add("@DIFFICULTY", SqlDbType.VarChar).Value = _MOM_RCPRow.DIFFICULTY;
                momCommand.Parameters.Add("@INGREDIENTS", SqlDbType.Text).Value = _MOM_RCPRow.INGREDIENTS;
                momCommand.Parameters.Add("@METHOD", SqlDbType.Text).Value = _MOM_RCPRow.METHOD;
                momCommand.Parameters.Add("@MOM_USR_ID", SqlDbType.BigInt).Value = _MOM_RCPRow.MOM_USR_ID;
                momCommand.Parameters.Add("@NAMESPACE", SqlDbType.VarChar).Value = MOMHelper.MOM_RECIPE_NAMESPACE;

                if (!_MOM_RCPRow.IsPHOTONull())
                    momCommand.Parameters.Add("@PHOTO", SqlDbType.VarChar).Value = _MOM_RCPRow.PHOTO;

                if (!_MOM_RCPRow.IsTAGSNull())
                    momCommand.Parameters.Add("@TAGS", SqlDbType.VarChar).Value = _MOM_RCPRow.TAGS;

                if (!_MOM_RCPRow.IsPREP_TMNull())
                    momCommand.Parameters.Add("@PREP_TM", SqlDbType.VarChar).Value = _MOM_RCPRow.PREP_TM;

                if (!_MOM_RCPRow.IsCOOK_TMNull())
                    momCommand.Parameters.Add("@COOK_TM", SqlDbType.VarChar).Value = _MOM_RCPRow.COOK_TM;

                if (!_MOM_RCPRow.IsSERVE_TONull())
                    momCommand.Parameters.Add("@SERVE_TO", SqlDbType.VarChar).Value = _MOM_RCPRow.SERVE_TO;

                if (!_MOM_RCPRow.IsVEGENull())
                    momCommand.Parameters.Add("@VEGE", SqlDbType.Bit).Value = _MOM_RCPRow.VEGE;

                if (!_MOM_RCPRow.IsVEGANNull())
                    momCommand.Parameters.Add("@VEGAN", SqlDbType.Bit).Value = _MOM_RCPRow.VEGAN;

                if (!_MOM_RCPRow.IsDAIRYNull())
                    momCommand.Parameters.Add("@DAIRY", SqlDbType.Bit).Value = _MOM_RCPRow.DAIRY;

                if (!_MOM_RCPRow.IsGLUTENNull())
                    momCommand.Parameters.Add("@GLUTEN", SqlDbType.Bit).Value = _MOM_RCPRow.GLUTEN;

                if (!_MOM_RCPRow.IsNUTNull())
                    momCommand.Parameters.Add("@NUT", SqlDbType.Bit).Value = _MOM_RCPRow.NUT;

                if (!_MOM_RCPRow.IsALLOWNull())
                    momCommand.Parameters.Add("@ALLOW", SqlDbType.Bit).Value = _MOM_RCPRow.ALLOW;

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

        public void GetMOM_RCPBy_ID(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_GET_BY_ID";
                momCommand.Parameters.Add("@ID", SqlDbType.Int).Value = _MOM_RCPRow.ID;

                MOMDataset momData = new MOMDataset();
                momData.Clear();
                momData.EnforceConstraints = false;
                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.TableMappings.Add("Table", momData.MOM_RCP.TableName);
                adapter.TableMappings.Add("Table1", momData.MOM_TAGS.TableName);
                adapter.SelectCommand = momCommand;
                adapter.Fill(momData);

                _MOM_RCPRow = momData.MOM_RCP[0];

                if(momData.MOM_TAGS.Rows.Count > 0)
                    _MOM_TAGSRow = momData.MOM_TAGS[0];
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

        public void GetMOM_RCPs(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_SEARCH";
                momCommand.Parameters.Add("@NAME", SqlDbType.NVarChar).Value = _MOM_RCPRow.NAME;
                momCommand.Parameters.Add("@DIFFICULTY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DIFFICULTY;

                if (_MOM_RCPRow.INGREDIENTS.Equals("True"))
                    momCommand.Parameters.Add("@INGREDIENTS", SqlDbType.NVarChar).Value = _MOM_RCPRow.INGREDIENTS;

                if (!_MOM_RCPRow.IsPHOTONull())
                    momCommand.Parameters.Add("@PHOTO", SqlDbType.NVarChar).Value = _MOM_RCPRow.PHOTO;

                if (!_MOM_RCPRow.IsVEGENull())
                    momCommand.Parameters.Add("@VEGE", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGE;

                if (!_MOM_RCPRow.IsVEGANNull())
                    momCommand.Parameters.Add("@VEGAN", SqlDbType.NVarChar).Value = _MOM_RCPRow.VEGAN;

                if (!_MOM_RCPRow.IsDAIRYNull())
                    momCommand.Parameters.Add("@DAIRY", SqlDbType.NVarChar).Value = _MOM_RCPRow.DAIRY;

                if (!_MOM_RCPRow.IsGLUTENNull())
                    momCommand.Parameters.Add("@GLUTEN", SqlDbType.NVarChar).Value = _MOM_RCPRow.GLUTEN;

                if (!_MOM_RCPRow.IsNUTNull())
                    momCommand.Parameters.Add("@NUT", SqlDbType.NVarChar).Value = _MOM_RCPRow.NUT;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();
                momDataSet.EnforceConstraints = false;
                adapter.TableMappings.Add("Table", momDataSet.MOM_RCP.TableName);
                adapter.Fill(momDataSet);

                _MOM_RCPDataTable = momDataSet.MOM_RCP;

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

        public void GetMOM_RCP_BYTag(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_GET_BY_TAG";
                momCommand.Parameters.Add("@TAGNAME", SqlDbType.NVarChar).Value = _MOM_RCPRow.TAGS;

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();
                momDataSet.EnforceConstraints = false;
                adapter.TableMappings.Add("Table", momDataSet.MOM_RCP.TableName);
                adapter.Fill(momDataSet);

                _MOM_RCPDataTable = momDataSet.MOM_RCP;

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

        public void AddMOM_RCP_VIEWS(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_RCP_VIEW";

                momCommand.Parameters.Add("@MOM_RCP_ID", SqlDbType.Int).Value = _MOM_RCPRow.ID;

                int rowsAffected = momCommand.ExecuteNonQuery();
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

        public void AddMOM_RCP_RATING(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "DBO.SP_MOM_RCP_RATING";

                momCommand.Parameters.Add("@MOM_RCP_ID", SqlDbType.Int).Value = _MOM_RCPRow.ID;
                momCommand.Parameters.Add("@RATINGS", SqlDbType.Float).Value = _MOM_RCPRow.RATING;

                int rowsAffected = momCommand.ExecuteNonQuery();
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

        public void GetMOM_RCP_GetRecent(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_GET_RECENT";

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();
                momDataSet.EnforceConstraints = false;
                adapter.TableMappings.Add("Table", momDataSet.MOM_RCP.TableName);
                adapter.Fill(momDataSet);

                _MOM_RCPDataTable = momDataSet.MOM_RCP;

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


        public void GetMOM_RCP_TopRated(out bool isSuccess, out string appMessage, out string sysMessage)
        {
            isSuccess = true;
            appMessage = "Success";
            sysMessage = string.Empty;

            try
            {
                SqlCommand momCommand = base.GetMOMCommand();
                momCommand.CommandText = "dbo.SP_MOM_RCP_GET_TOPRATED";

                SqlDataAdapter adapter = new SqlDataAdapter();
                adapter.SelectCommand = momCommand;

                MOMDataset momDataSet = new MOMDataset();
                momDataSet.EnforceConstraints = false;
                adapter.TableMappings.Add("Table", momDataSet.MOM_RCP.TableName);
                adapter.Fill(momDataSet);

                _MOM_RCPDataTable = momDataSet.MOM_RCP;

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

