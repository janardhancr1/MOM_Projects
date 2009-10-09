using System;
using System.Collections.Generic;
using System.Text;
using System.Data;
using System.Data.SqlClient;
using System.Web;
using System.Configuration;
using System.Web.Configuration;

namespace DALMomburbia
{
    public class MOMBase
    {
        protected SqlConnection _MOMConnection = null;

        public SqlConnection MOMConnection
        {
            set { _MOMConnection = value; }
            get { return _MOMConnection; }
        }

        public MOMBase()
        {
            //if (_MOMConnection == null)
            //{
            //    string momConnectionString = ConfigurationManager.ConnectionStrings["momConnectionString"].ConnectionString;

            //    _MOMConnection = new SqlConnection();
            //    _MOMConnection.ConnectionString = momConnectionString;
            //    _MOMConnection.Open();
            //}
        }

        protected void GetConnection()
        {
            if (_MOMConnection == null || _MOMConnection.State != ConnectionState.Open )
            {
                string momConnectionString = ConfigurationManager.ConnectionStrings["momConnectionString"].ConnectionString;

                _MOMConnection = new SqlConnection();
                _MOMConnection.ConnectionString = momConnectionString;
                _MOMConnection.Open();
            }
        }

        protected void CloseConnection()
        {
            if (_MOMConnection.State != ConnectionState.Closed)
                _MOMConnection.Close();

            _MOMConnection = null;
        }

        protected SqlCommand GetMOMCommand()
        {
            //if (_MOMConnection == null || _MOMConnection.State != ConnectionState.Open)
            //{
                //GetConnection();
                //string momConnectionString = ConfigurationManager.ConnectionStrings["momConnectionString"].ConnectionString;

                //_MOMConnection = new SqlConnection();
                //_MOMConnection.ConnectionString = momConnectionString;
                //_MOMConnection.Open();
            //}

            GetConnection();

            SqlCommand MOMCommand = new SqlCommand();
            MOMCommand.CommandType = CommandType.StoredProcedure;
            MOMCommand.Connection = _MOMConnection;

            return MOMCommand;
        }
    }
}
